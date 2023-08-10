<?php

namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;

/** Controller for general pages on admin module */
class SiteController extends \common\controllers\SiteController {

	/** @inheritdoc */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['error', 'login', 'reset-password', 'auth', 'logout'],
						'allow' => true,
					],
					[
						'actions' => ['index', 'metrics'],
						'allow' => true,
						'roles' => ['admin']
					]
				]
			]
		];
	}

	public function actionIndex() {
		return $this->redirect(['/user/index']);
	}
}
