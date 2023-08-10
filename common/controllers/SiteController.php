<?php

namespace common\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;

class SiteController extends \TiCMS\controllers\SiteController {

	protected $loginView = '@common/views/site/login';
	protected $resetView = '@common/views/site/reset-password';

	public function init() {
		if (!Yii::$app->user->isGuest) {

			Yii::$app->language = Yii::$app->user->identity->language_slug ?? 'en';
		}
		return parent::init();
	}

	public function getDisplayName() {
		$title = $this->modelClass::tableName();
		$title = str_replace('_', ' ', $title);
		return ucwords($title);
	}

	/** @inheritdoc */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => [
							'error',
							'login',
							'reset-password',
							'auth',
							'logout',
							'ping'
						],
						'allow' => true,
					],
					[
						'actions' => ['*'],
						'allow' => false
					]
				]
			]
		];
	}

	public function actions() {
		$actions = parent::actions();
		$actions['login'] = [
			'class' => '\common\actions\LoginAction',
			'viewName' => $this->loginView
		];
		$actions['reset-password'] = [
			'class' => '\common\actions\ResetPasswordAction',
			'viewName' => $this->resetView
		];
		unset($actions['error']);
		return $actions;
	}

	public function actionError() {
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			return $this->render('@common/views/site/error', [
				'exception' => $exception,
				'statusCode' => $exception->statusCode,
				'message' => $exception->getMessage(),
				'file' => $exception->getFile(),
				'line' => $exception->getLine(),
				'code' => $exception->getCode(),
				'xdebug_message' => $exception->xdebug_message,
			]);
		}

		return '';
	}

	public function actionPing() {
		Yii::$app->response->format = Response::FORMAT_JSON;
		return ['pong' => !Yii::$app->user->isGuest];
	}
}
