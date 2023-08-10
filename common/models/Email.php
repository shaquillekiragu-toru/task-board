<?php

namespace common\models;

use yii;
use Ramsey\Uuid\Uuid;
use Soundasleep\Html2Text;
use Aws\Exception\AwsException;
use common\helpers\AWSCredentials;
use PHPMailer\PHPMailer\PHPMailer;

class Email extends \common\models\RestModel {

	const STATUS_PENDING = 'PENDING';
	const STATUS_SCHEDULED = 'SCHEDULED';
	const STATUS_SENT = 'SENT';
	const STATUS_ERROR = 'ERROR';

	public static function tableName() {
		return 'email';
	}

	/* @inheritdoc */
	public function rules(): array {
		return array_merge(parent::rules(), [
			[
				[
					'email',
					'status',
					'model_name',
					'template',
					'params',
					'ses_id',
					'subject',
					'error',
				],
				'string'
			],
			[
				[
					'model_id',
					'sent_at',
					'scheduled_for'
				],
				'integer'
			],
			[
				[
					'email'
				],
				'required'
			]
		]);
	}

	public function beforeSave($insert) {
		if ($this->isNewRecord && ($this->status == null || strlen($this->status) == 0)) {
			$this->status = self::STATUS_PENDING;
		}

		return parent::beforeSave($insert);
	}

	public function setSlugFromTitle() {
		if (!isset($this->slug) || empty($this->slug)) {
			$this->slug = \Ramsey\Uuid\Uuid::uuid4()->toString();
		}
	}

	public function renderEmail() {
		if ($this->model_id != null) {
			$params = $this->model_name::findOne(['id' => $this->model_id]);
		} else {
			$params = json_decode($this->params);
		}

		$template = $this->template;

		if (!file_exists(Yii::getAlias($template))) {
			$template = '@root/vendor/toruinteractive/ti-notify/templates/' . $template;

			if (substr($template, -4) != '.php') {
				$template .= '.php';
			}
		}

		if (!file_exists(Yii::getAlias($template))) {
			return false;
		}

		return Yii::$app->controller->renderFile($template, ['params' => $params]);
	}

	private function addAttachmentsToMail(&$mail) {
		$attachments = json_decode($this->attachments) ?? [];
		foreach ($attachments as $file_title => $file_data) {

			if (is_string($file_data)) {
				$file_path = $file_data;
				if (is_numeric($file_title)) {
					$file_title = basename($file_path);
				}

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $file_path);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($ch);
				curl_close($ch);
				$path = sys_get_temp_dir() . '/' . time();
				file_put_contents($path, $data);
				$mail->addAttachment($path, $file_title);
			}

			if (is_array($file_data)) {
				$file_data = (object) $file_data;
			}

			if (is_object($file_data)) {
				if ($file_data->type == 'ical') {
					$mail->addStringAttachment(base64_decode($file_data->body), $file_title, 'base64', 'text/calendar');
				}

				if ($file_data->type == 'pdf') {
					$mail->addStringAttachment(base64_decode($file_data->body), $file_title, 'base64', 'application/pdf');
				}
			}
		}
	}

	private function addBodyToMail(&$mail) {
		$html_body = $this->renderEmail();
		$text_body = Html2Text::convert($html_body, [
			'ignore_errors' => true,
			'drop_links' => true
		]);
		$mail->Body = $html_body;
		$mail->AltBody = $text_body;
	}

	public function send(): bool {
		if ($this->model_id != null) {
			$model = $this->model_name::findOne(['id' => $this->model_id]);

			if (!$model) {
				sscanf($this->error, 'Could not find %s on %s', $this->model_name, $this->model_id);
				$this->status = self::STATUS_ERROR;
				$this->save();
				return false;
			}
		}

		$client = AWSCredentials::getSesClient();

		try {
			$mail = new PHPMailer();
			$mail->charSet = "UTF-8";
			$mail->Encoding = 'base64';
			$mail->setFrom(Yii::$app->params['notify']['email']['support-address'], APP_NAME);
			foreach (explode(',', $this->email) as $email) {
				$mail->addAddress($email);
			}
			$mail->Subject = $this->subject;
			$this->addBodyToMail($mail);
			$this->addAttachmentsToMail($mail);

			if (!$mail->preSend()) {
				$this->error = $mail->ErrorInfo;
				$this->status = self::STATUS_ERROR;
			} else {
				$message = $mail->getSentMIMEMessage();

				$result = $client->sendRawEmail([
					'RawMessage' => [
						'Data' => $message
					]
				]);

				$this->ses_id = $result['MessageId'];
				$this->status = self::STATUS_SENT;
			}
		}
		catch (AwsException $e) {
			$this->error = $e->getAwsErrorMessage();
			$this->status = self::STATUS_ERROR;
		}
		$this->save();

		return $this->status == self::STATUS_SENT;
	}
}
