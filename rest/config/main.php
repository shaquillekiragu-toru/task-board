<?php

$params = array_replace_recursive(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => APP_SLUG . '-rest',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'rest\controllers',
	'bootstrap' => [],
	'modules' => [],
	'components' => [
		'response' => [
			'format' => yii\web\Response::FORMAT_JSON,
			'charset' => 'UTF-8',
		],
		'request' => [
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			],
			'enableCookieValidation' => false,
		],
		'user' => [
			'enableAutoLogin' => false,
			'enableSession' => false,
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
			'showScriptName' => false,
			'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['user'],
					'patterns' => [
						'OPTIONS options' => 'options',

						'GET search_template' => 'search_template',
						'GET,POST search' => 'search',

						'search_template' => 'options',
						'search' => 'options',

						'GET suggest_options' => 'suggest_options',
						'suggest_options' => 'options',

						'POST suggest_list/<id:\d+>' => 'suggest_list',
						'suggest_list/<id:\d+>' => 'options',
					]
				],
			]
		],
		'assetManager' => [
			'basePath' => '@rest/web/assets'
		]
	],

	'params' => $params,
];
