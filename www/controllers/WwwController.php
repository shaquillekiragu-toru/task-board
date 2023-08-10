<?php

namespace www\controllers;

use yii\helpers\Inflector;

class WwwController extends \common\controllers\WebController {

	public function actions() {
		return [
			'index',
			'create',
			'view',
			'update',
			'delete',
		];
	}

	public function beforeAction($action) {

		if (!isset($this->view->title) || isEmpty($this->view->title)) {
			$this->view->title = Inflector::titleize(str_replace('-', ' ', \Yii::$app->controller->action->id), true);
		}

		\Yii::$app->controller->view->title = $this->view->title;

		return parent::beforeAction($action);
	}
}
