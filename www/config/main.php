<?php

$params = array_merge_recursive(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => APP_SLUG . '-www',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'www\controllers',
	'params' => $params,
	'layoutPath' => '@common/views/layouts',
	'layout' => 'main.php',
	'defaultRoute' => '/task/index',
];
