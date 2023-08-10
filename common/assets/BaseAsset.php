<?php

namespace common\assets;

use yii\web\AssetBundle;

class BaseAsset extends AssetBundle {
	public $sourcePath = "@vendor/toruinteractive/ti-cms/assets/base/build";
	public $publishOptions = ["forceCopy" => false];
	public $depends = [];
	public $js = ["base.min.js"];
	public $css = ["base.css"];
}
