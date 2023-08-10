<?php

namespace api\controllers;

use yii;
use TiCMS\controllers\RestBaseController;
use yii\web\HttpException;

class ApiController extends RestBaseController {

	public $modelClass = '\yii\web\Base';
	public $enableCsrfValidation = false;

	public function behaviors() {
		$behaviors = parent::behaviors();

		$auth = $behaviors['authenticator'];
		unset($behaviors['authenticator']);

		$behaviors['corsFilter'] = [
			'class' => \yii\filters\Cors::className(),
		];

		$behaviors['authenticator'] = $auth;
		$behaviors['authenticator']['except'] = ['options'];

		$behaviors['contentNegotiator'] = [
			'class' => 'yii\filters\ContentNegotiator',
			'formats' => [
				'application/json' => \yii\web\Response::FORMAT_JSON,
			]
		];

		return $behaviors;
	}

	public function actions() {
		$actions = parent::actions();

		if (key_exists('index', $actions)) {
			if (!Yii::$app->request->isOptions) {
				if (Yii::$app->request->get('filter', null) != null) {
					$actions['index']['dataFilter'] = [
						'class' => 'yii\data\ActiveDataFilter',
						'searchModel' => $this->buildSearchModel(),
					];
				}

				$actions['index']['prepareSearchQuery'] = [
					$this,
					'prepareSearchQueryHandler',
				];
			}
		}

		return $actions;
	}

	public function findOne($id, $model_name = null) {
		if ($model_name == null) {
			$model_name = $this->modelClass;
		}

		$query = $model_name::find()->where(['id' => $id]);

		$model = $query->one();
		if (!$model) {
			throw new HttpException(404, 'Record not found');
		}

		return $model;
	}

	public function findAll($condition, $model_name = null) {
		if ($model_name == null) {
			$model_name = $this->modelClass;
		}

		$query = $model_name::find()->where($condition);

		return $query->all();
	}
}
