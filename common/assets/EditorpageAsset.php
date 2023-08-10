<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii;

class EditorpageAsset extends AssetBundle {
	public $sourcePath = "@common/web/css";
	public $publishOptions = ["forceCopy" => YII_DEBUG];
	public $depends = [
		'yii\web\YiiAsset'
	];

	public $css = [
		'editorpage-view.css'
	];
}
