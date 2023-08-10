<?php

namespace console\controllers;

use yii;
use yii\console\Controller;

class UacController extends Controller {

	public function actionChangePassword($email, $password) {
		$model = \common\models\User::find()->where(['email' => $email])->one();
		if (!$model) {
			printf("No user with email %s found\n", $email);
			return;
		}
		$model->setPassword($password);
		$model->save();
		printf("Complete\n");
	}

	public function actionPermission($email, $permission) {
		$model = \common\models\User::find()->where(['email' => $email])->one();
		if (!$model) {
			printf("No user with email %s found\n", $email);
			return;
		}
		$auth = Yii::$app->authManager;
		$auth->revokeAll($model->id);
		$newRole = $auth->getRole(strtolower($permission));
		$auth->assign($newRole, $model->id);
		printf("Complete\n");
	}

	public function actionFind($term) {
		$query = \common\models\User::find();

		$query->where([
			'LIKE',
			'title',
			$term
		]);

		foreach ($query->all() as $model) {
			printf("%s\t %s\n", $model->full_name, $model->email);
		}
	}
}
