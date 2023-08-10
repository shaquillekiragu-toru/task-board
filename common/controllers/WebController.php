<?php

namespace common\controllers;

use yii\filters\AccessControl;

class WebController extends \TiCMS\controllers\WebController {

	/** @inheritdoc */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => [],
						'allow' => true,
						'roles' => [
							'staff'
						]
					],
					[
						'actions' => ['*'],
						'allow' => false,
					]
				]
			]
		];
	}

	public function getDisplayName() {
		$title = $this->modelClass::tableName();
		$title = str_replace('_', ' ', $title);
		return \yii\helpers\Inflector::pluralize(ucwords($title));
	}
}
