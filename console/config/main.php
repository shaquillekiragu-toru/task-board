<?php

$params = array_merge_recursive(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => APP_SLUG . '-console',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log', 'queue'],
	'controllerMap' => [
		'migrate' => [
			'class' => 'yii\console\controllers\MigrateController',
			'migrationTable' => 'migration',
			'templateFile' => '@console/migrations/template.php'
		],
		'migrate-cms' => [
			'class' => 'TiCMS\console\controllers\MigrateController'
		],
	],
	'components' => [
		'log' => [
			'traceLevel' => 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['trace'],
					'categories' => ['sync'],
					'logFile' => '@console/runtime/logs/debug.log',
				]
			],
		]
	],
	'controllerNamespace' => 'console\controllers',
	'params' => $params,
	'vendorPath' => dirname(dirname(dirname(__DIR__))) . '/vendor'
];
