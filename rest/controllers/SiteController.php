<?php

namespace rest\controllers;

class SiteController extends \yii\web\Controller {

	public function actionIndex() {
	}

	public function actionError() {
		$exception = \Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			print_r($exception);
		}
	}
}
