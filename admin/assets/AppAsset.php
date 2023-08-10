<?php

namespace admin\assets;

/**
 * load in the global js/css files for this module, and set
 * sependencies.
 */
class AppAsset extends \common\assets\ModuleAsset {
	public $basePath = '@admin';
	public $baseUrl = '@web/';

	public $js = ["/js/layouts-main.js"];
	public $css = ["/css/layouts-main.css"];

	public $depends = [
		'yii\web\YiiAsset',
		'TiImage\assets\ImageAsset',
		'TiCMS\assets\base\BaseAsset',
		"yii\web\JqueryAsset"
	];
}
