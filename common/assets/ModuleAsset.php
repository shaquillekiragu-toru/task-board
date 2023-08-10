<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii;

class ModuleAsset extends AssetBundle {

	public function init() {
		array_push($this->css, 'css/layouts-main.css');
		array_push($this->js, 'js/layouts-main.js');

		$ctrl = Yii::$app->controller;
		$action = Yii::$app->controller->action;

		if (!empty($ctrl) && !empty($action)) {
			$path = strtolower($ctrl->id . "-" . $action->id);

			if (file_exists(Yii::getAlias("@app") . '/web/' . 'js/' . $path . '.js')) {
				array_push($this->js, 'js/' . $path . '.js');
			}

			if (file_exists(Yii::getAlias("@app") . '/web/' . 'css/' . $path . '.css')) {
				array_push($this->css, 'css/' . $path . '.css');
			}
		}

		return parent::init();
	}
}
