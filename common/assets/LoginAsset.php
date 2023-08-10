<?php

namespace common\assets;

class LoginAsset extends ModuleAsset {
	public $sourcePath = "@webroot";
	public $baseUrl = '@web/';
	public $publishOptions = ['forceCopy' => YII_DEBUG];

	public $depends = [
		'TiCMS\assets\base\BaseAsset',
		'common\assets\BootstrapAsset'
	];

	public $css = [];
	public $js = [];
}
