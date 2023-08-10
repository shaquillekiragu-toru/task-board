<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

class LoginForm extends \TiCMS\models\LoginForm {
	public $remember_me = false;

	public function rules() {
		return [
			[['username', 'password'], 'required'],
			['forgot', 'boolean'],
			['password', 'validatePassword'],
			[['forgot', 'remember_me'], 'safe']
		];
	}

	public function login() {
		if ($this->validate()) {
			$user = $this->getUser();
			if ($user->mfa_enabled == 1 && strlen($this->mfaCode) <= 0) {
				return 1;
			}
			if ($user->mfa_enabled) {
				if (!$user->validateMFACode($this->mfaCode)) {
					$this->addError('password', 'Incorrect mfa code');
					return 1;
				}
			}

			if (Yii::$app->user->login($user, $this->remember_me ? 0 : 3600)) {
				Yii::$app->session->set('user.email', $user->email);
				$user->registerSigninActivity('unpw');
				return 2;
			}
		}

		return 0;
	}

	public function sendPassword() {
		$user = $this->getUser();
		if (!$user) {
			$this->addError('password', 'Email not found');
			return;
		}

		if (!$user::isPasswordResetTokenValid($user->password_reset_token)) {
			$user->generatePasswordResetToken();
		}

		if ($user->save() == false) {
			$this->addError('password', 'Error generating reset token');
			return;
		}

		$reset_link = Yii::$app->urlManager->createAbsoluteUrl([
			'site/reset-password',
			'token' => $user->password_reset_token
		]);

		$model = new Email();
		$model->email = $user->email;
		$model->subject = "Password Reset Request";
		$model->template = '@emails/reset-password.php';
		$model->params = json_encode((object) [
			'name' => Html::encode($user->full_name),
			'url' => Html::encode($reset_link)
		]);
		$result = $model->save();
		if ($result == false) {
			$errors = $model->getErrors();
			$error = array_pop($errors)[0];
			$this->addError('password', $error);
		}
	}
}
