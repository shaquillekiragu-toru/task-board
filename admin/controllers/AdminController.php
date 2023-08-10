<?php

namespace admin\controllers;

use Yii;
use yii\web\HttpException;

class AdminController extends \TiCMS\controllers\WebController {

	public function init() {
		if (!Yii::$app->user->isGuest) {

			Yii::$app->language = Yii::$app->user->identity->language_slug ?? 'en';
		}
		return parent::init();
	}

	/* @inheritdoc */
	public function actionDelete(int $id) {
		$model = $this->findModel($id);

		if ($model->protected) {
			throw new HttpException(403, "This {$this->shortName} cannot be deleted");
		}

		if (Yii::$app->request->isPost) {
			if ($model->delete()) {
				Yii::$app->getSession()->setFlash('success', "{$this->shortName} deleted");

				return $this->redirect("/" . Yii::$app->controller->id);
			}

			Yii::$app->getSession()->setFlash('error', "Error deleting {$this->shortName}");
		}

		return $this->render('delete', ['model' => $model]);
	}
}
