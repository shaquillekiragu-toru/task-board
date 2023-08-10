<?php

$params = array_replace_recursive(
	require(__DIR__ . '/../../common/config/params.php'),
	require(__DIR__ . '/../../common/config/params-local.php'),
	require(__DIR__ . '/params.php'),
	require(__DIR__ . '/params-local.php')
);

return [
	'id' => 'admin',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'admin\controllers',
	'bootstrap' => ['super'],
	'modules' => [
		'super' => [
			'class' => 'TiSuperadmin\modules\admin\Module',
		],
	],
	'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
				'signup' => 'site/signup',
				'site/<action:\w+>' => 'site/<action>',

				'<controller:(settings)>/<action:[\w\-]+>/<context:[\w\-]+>' => '<controller>/<action>',
				'<controller:(settings)>/<action:[\w\-]+>/<context:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
				'<controller:(settings)>/<action:[\w\-]+>/<context:[\w\-]+>/<slug:.+>' => '<controller>/<action>',

				'<controller:(menu)>/<action:[\w\-]+>/<context:[\w\-]+>' => '<controller>/<action>',

				'<controller:\w+>/<action:([\w\-]+)>/<id:\d+>/<id2:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:([\w\-]+)>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:([\w\-]+)>/<slug:.+>' => '<controller>/<action>',
				'<controller:\w+>/<action:([\w\-]+)>' => '<controller>/<action>',

				'<controller:(settings)>/<action:[\w\-]+>/<context:[\w\-]+>/<id:\d+>/<id2:\w+>' => '<controller>/<action>',
			]
		]
	],

	'params' => $params
];
