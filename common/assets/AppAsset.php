<?php

namespace common\assets;

use yii\web\AssetBundle;
use Yii;

class AppAsset extends ModuleAsset {
	public $basePath = "@root";
	public $baseUrl = '@web/';
	public $css = ['/css/layouts-main.css', '/css/site-login.css'];
	public $js = ['/js/layouts-main.js'];

	public $depends = [
		'TiImage\assets\ImageAsset',
		'common\assets\BaseAsset',
		"admin\assets\TippyAsset",
		"admin\assets\ChartJSAsset",
	];

	public $publishOptions = ["forceCopy" => false];
}
