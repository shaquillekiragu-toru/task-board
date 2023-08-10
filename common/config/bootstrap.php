<?php

$composer_path = dirname(dirname(__DIR__)) . '/composer.json';

if (file_exists($composer_path)) {
	$composer_json = json_decode(file_get_contents($composer_path), true);
} else {
	$composer_json = [];
}

define('VERSION', key_exists('version', $composer_json) ? $composer_json['version'] : '0.0.1');
define('APP_SLUG', key_exists('name', $composer_json) ? $composer_json['name'] : 'project/template');
define('APP_NAME', key_exists('display_name', $composer_json) ? $composer_json['display_name'] : APP_SLUG);
define('MODULES', key_exists('modules', $composer_json) ? $composer_json['modules'] : 'www admin rest common console');

if (!defined('YII_DEBUG')) {
	define('YII_DEBUG', (defined('YII_ENV') ? YII_ENV : 'local') == 'local');
}

foreach (explode(' ', MODULES) as $module) {
	$lc = strtolower($module);
	$uc = strtoupper($module);

	define($uc, SCHEMA . '://' . $lc . '.' . DOMAIN);
}

try {
	$doc_root_split = explode('/', $_SERVER['DOCUMENT_ROOT']);
	array_pop($doc_root_split);
	$module_name = array_pop($doc_root_split);

	define('THIS_MODULE', SCHEMA . '://' . $module_name . '.' . DOMAIN);
}
catch (\Exception $ex) {
	define('THIS_MODULE', ADMIN);
}

$basePath = dirname(dirname(__DIR__));

if (class_exists('Yii')) {
	Yii::setAlias('@node_modules', $basePath . '/node_modules');
	Yii::setAlias('@vendor', $basePath . '/vendor');
	Yii::setAlias('@bower', $basePath . '/vendor/bower-asset');
	Yii::setAlias('@base', $basePath);
	Yii::setAlias('@common', $basePath . '/common');
	Yii::setAlias('@console', $basePath . '/console');
	Yii::setAlias('@root', $basePath);

	foreach (explode(' ', MODULES) as $module) {
		$lc = strtolower($module);
		Yii::setAlias('@' . $lc, $basePath . '/' . $lc);
	}

	Yii::setAlias('@ticms', $basePath . '/vendor/toruinteractive/ti-cms');
	Yii::setAlias('@tmp', $basePath . '/scratch');
	Yii::setAlias('@images', Yii::getAlias('@admin/web/images'));
	Yii::setAlias('@liveedit', Yii::getAlias('@common/views/liveedit'));
	Yii::setAlias('@emails', Yii::getAlias('@common/emails/dist'));
}
