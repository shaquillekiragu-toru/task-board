<?php

namespace www\controllers;

use Yii;
use yii\web\HttpException;

class SiteController extends \TiCMS\controllers\SiteController
{

	public $owner = null;

	public function actions()
	{
		$actions = parent::actions();
		$actions['login']["viewName"] = '@www/views/site/login';
		return $actions;
	}

	public function actionIndex()
	{
		return $this->redirect(['task/index']);
	}

	public function actionTest()
	{
		return $this->render('test');
	}

	public function actionError()
	{
		$exception = Yii::$app->errorHandler->exception;

		if ($exception === null) {
			$exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
		}

		if ($exception instanceof HttpException) {
			$code = $exception->statusCode;
		} else {
			$code = $exception->getCode();
		}

		$name = $exception instanceof HttpException ? Yii::t('yii', 'Error {code}', ['code' => $code]) : Yii::t('yii', 'Error');
		$message = $exception->getMessage();

		if (YII_DEBUG) {
			$name = Yii::t('yii', 'Error {code}', ['code' => $code]);
		}

		return $this->render('error', [
			'name' => $name,
			'message' => $message,
			'exception' => $exception,
		]);
	}
}
