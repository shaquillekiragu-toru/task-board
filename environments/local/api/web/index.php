<?php

error_reporting(E_ERROR | E_WARNING);

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../common/config/bootstrap-local.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap-local.php');
require(__DIR__ . '/../config/bootstrap.php');

$config_common = yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../../common/config/main.php'),
	require(__DIR__ . '/../../common/config/main-local.php')
);

$config_common['components']['urlManager']['rules'] = [];

$config = yii\helpers\ArrayHelper::merge(
	$config_common,
	require(__DIR__ . '/../config/main.php'),
	require(__DIR__ . '/../config/main-local.php')
);

$modules = defined('API_MODULES') ? explode(" ", API_MODULES) : [];
foreach ($modules as $module) {
	$module_path = __DIR__ . '/../modules/' . $module . '/config/main.php';
	if (file_exists($module_path)) {
		$config = yii\helpers\ArrayHelper::merge(
			$config,
			require($module_path)
		);
	}
}

$application = new yii\web\Application($config);
$application->run();
