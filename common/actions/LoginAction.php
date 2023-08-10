<?php

namespace common\actions;

use Yii;
use common\models\LoginForm;

/**
 * This action renders the login form and processes it's results.
 * Added to base site controller in  TiCMS\controllers\SiteController
 */
class LoginAction extends \TiLogin\actions\LoginAction {

	/**
	 * The name of the view to render.
	 * @var string
	 */
	public $viewName = '/site/login';

	/**
	 * @inheritdoc
	 * @return [type] [description]
	 */
	public function run() {

		if (!\Yii::$app->user->isGuest) {
			return $this->controller->goHome();
		}

		$model = new LoginForm();
		$model->forgot = 0;

		if ($model->load(Yii::$app->request->post())) {
			if (isset(Yii::$app->request->post()['LoginForm']['mfaCode'])) {
				$model->mfaCode = Yii::$app->request->post()['LoginForm']['mfaCode'];
			}

			if ($model->forgot == 1) {

				$model->sendPassword();
				if (!$model->hasErrors()) {
					$model->forgot = 2;
				}
			} else {
				$loginState = $model->login();

				if ($loginState == 2) {

					if (empty(Yii::$app->user->returnUrl) && Yii::$app->request->isAjax) {
						return Yii::$app->getHomeUrl();
					}

					return $this->controller->goBack();
				} else if ($loginState == 1) {
					$model->promptMFA = true;
				}
			}
		}

		return $this->controller->render($this->viewName, [
			'model' => $model,
		]);
	}
}
