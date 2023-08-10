<?php

namespace admin\controllers;

use TiCMS\controllers\WebController;
use yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\models\Subscriber;
use yii\web\HttpException;

/**
 * Sitesetting Controller.
 */
class SitesettingController extends WebController {
	public $modelClass = 'rest\models\Sitesetting';

	/* @inheritdoc */
	public function behaviors(): array {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => [
							'view',
							'create',
							'update',
							'delete'
						],
						'allow' => true,
						'roles' => ['admin']
					],
					[
						'actions' => ['*'],
						'allow' => false
					],
				],
			]
		];
	}

	/* @inheritdoc */
	public function beforeAction($action) {

		if (parent::beforeAction($action)) {
			Yii::$app->view->params['breadcrumbs'][] = [
				'label' => 'Settings',
				'url' => '/settings/index/sitesetting',
				'icon' => 'icon-hammer-wrench'
			];
		}

		return $action;
	}

	/* @inheritdoc */
	public function actionDelete(int $id) {
		$model = $this->findModel($id);

		if ($model->protected) {
			throw new HttpException(403, "This Sitesetting cannot be deleted");
		}

		if (Yii::$app->request->isPost) {
			if ($model->delete()) {
				Yii::$app->getSession()->setFlash('success', "Sitesetting deleted");
				return $this->redirect(['/settings/index']);
			}

			Yii::$app->getSession()->setFlash('error', "Error deleting Sitesetting");
		}

		return $this->render('delete', ['model' => $model]);
	}
}
