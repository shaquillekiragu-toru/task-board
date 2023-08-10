<?php

namespace admin\controllers;

use Yii;
use yii\web\HttpException;
use yii\filters\AccessControl;

class UserController extends AdminController {
	/* @inheritdoc */
	public $modelClass = 'rest\models\User';

	/* @inheritdoc */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => [
							'create',
							'index',
							'view',
							'update',
							'delete',
							'reset-password',
							'loginas'
						],
						'allow' => true,
						'roles' => ['admin']
					],
					['actions' => ['*'], 'allow' => false],
				],
			]
		];
	}

	public function actionLoginas($id) {
		if (YII_ENV == 'production') {
			throw new HttpException(500, 'This cannot be done on production');
		}

		$model = $this->modelClass::findOne(['id' => $id]);

		if (!$model) {
			return $this->redirect('/');
		}


		Yii::$app->user->login($model, 0);

		return $this->redirect('/');
	}
}
