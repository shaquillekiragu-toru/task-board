<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\Email;

class EmailController extends Controller {

	const SENT_EMAILS_DAYS_RETAINED = 3;
	const ERRORED_EMAILS_DAYS_RETAINED = 10;
	const SECONDS_IN_DAY = 86400;
	const EMAIL_BATCH_SIZE = 10;

	public function actionSendEmailBatch() {
		$models = Email::find()
			->where(['status' => Email::STATUS_PENDING])
			->orWhere(['and', ['status' => Email::STATUS_SCHEDULED], ['scheduled_for' => date('Y-m-d')]])
			->limit(self::EMAIL_BATCH_SIZE)
			->all();

		foreach ($models as $model) {
			$model->send();
		}
	}

	public function actionDeleteOldEmails() {
		$models = Email::find()
			->where([
				'and',
				['status' => Email::STATUS_SENT],
				['<', 'sent_at', self::SENT_EMAILS_DAYS_RETAINED * self::SECONDS_IN_DAY]
			])
			->orWhere([
				'and',
				['status' => Email::STATUS_ERROR],
				['<', 'sent_at', self::ERRORED_EMAILS_DAYS_RETAINED * self::SECONDS_IN_DAY]
			])
			->limit(self::EMAIL_BATCH_SIZE)
			->all();

		foreach ($models as $model) {
			$model->delete();
		}
	}
}
