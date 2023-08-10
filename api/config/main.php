<?php

$params = array_replace_recursive(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => APP_SLUG . '-api',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'api\controllers',
	'components' => [
		'response' => [
			'format' => \yii\web\Response::FORMAT_JSON,
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
			'identityClass' => 'api\models\User',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
			'showScriptName' => false,
			'rules' => [

				// OPTIONS
				'OPTIONS <controller:[\w-]+>/<action[\w-]+>/<id:\d+>' => '<controller>/options',
				'OPTIONS <controller:[\w-]+>/<id:\d+>' => '<controller>/options',
				'OPTIONS <controller:[\w-]+>/<action[\w-]+>' => '<controller>/options',
				// 'OPTIONS <controller:[\w-]+>/<slug:[\w-]+>' => '<controller>/options',
				'OPTIONS <controller:[\w-]+>' => '<controller>/options',
				'OPTIONS <controller:(user)+>/<action>' => '<controller>/options',
				'OPTIONS <controller:(user)+>' => '<controller>/options',

				// POST
				'POST <controller:[\w-]+>/<action[\w-]+>/<id:\d+>' => '<controller>/<action>',
				'POST <controller:[\w-]+>/<id:\d+>' => '<controller>/create',
				'POST <controller:[\w-]+>/<action[\w-]+>' => '<controller>/<action>',
				// 'POST <controller:[\w-]+>/<slug:[\w-]+>' => '<controller>/create',
				'POST <controller:[\w-]+>' => '<controller>/create',
				'POST <controller:(user)+>/<action>' => '<controller>/<action>',

				// PUT
				'PUT <controller:[\w-]+>/<action[\w-]+>/<id:\d+>' => '<controller>/<action>',
				'PUT <controller:[\w-]+>/<id:\d+>' => '<controller>/update',
				'PUT <controller:[\w-]+>/<action[\w-]+>' => '<controller>/<action>',
				// 'PUT <controller:[\w-]+>/<slug:[\w-]+>' => '<controller>/update',
				'PUT <controller:(user)+>/<action>' => '<controller>/<action>',

				// DELETE
				'DELETE <controller:[\w-]+>/<id:\d+>' => '<controller>/delete',
				// 'DELETE <controller:[\w-]+>/<slug:[\w-]+>' => '<controller>/delete',

				// GET
				'GET <controller:[\w-]+>/<action[\w-]+>/<id:\d+>' => '<controller>/<action>',
				'GET <controller:[\w-]+>/<id:\d+>' => '<controller>/view',
				// 'GET <controller:[\w-]+>/<id:[\w-]+>' => '<controller>/view',
				'GET <controller:[\w-]+>/<action[\w-]+>' => '<controller>/<action>',
				'GET <controller:[\w-]+>' => '<controller>/index',
				'GET <controller:(user)+>/<action>' => '<controller>/<action>',
				'GET <controller:(user)+>' => '<controller>/index',


				'<controller:[\w-]+>/<action[\w-]+>/<id:\d+>' => '<controller>/<action>',
				'<controller:[\w-]+>/<action[\w-]+>' => '<controller>/<action>',
			]
		],
	],

	'params' => $params,
];
