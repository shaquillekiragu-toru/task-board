<?php

namespace console\controllers;

use yii\console\Controller;

class SaveController extends Controller {

	public function actionAll($model_name) {
		if (!class_exists($model_name)) {
			$model_name = "common\\models\\" . $model_name;
		}

		if (!class_exists($model_name)) {
			echo "Unknown class " . $model_name;
			exit(-1);
		}

		$i = 1;
		$total = $model_name::find()->count();

		$query = $model_name::find();
		foreach ($query->each() as $model) {
			if (!$model->save()) {
				echo "Model " . $model->id . "\n";
				var_dump($model->getErrors());
			}

			echo ($i++) . "/" . $total . "\r";
		}
		echo "\n";
		echo "Done\n\r";
	}

	public function actionOne($model_name, $id) {
		$model_str = "common\\models\\" . $model_name;

		$model = $model_str::find()->where(['id' => $id])->one();

		if (!$model) {
			echo "could not find model \n";
		} else {
			if (!$model->save()) {
				var_dump($model->getErrors());
			}
			echo "Done\n\r";
		}
	}
}
