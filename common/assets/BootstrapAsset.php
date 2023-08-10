<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle {
	public $sourcePath = '@vendor/bower/bootstrap/dist';
	public $css = ['css/bootstrap.min.css'];
	public $js = ['js/bootstrap.bundle.min.js'];
}
