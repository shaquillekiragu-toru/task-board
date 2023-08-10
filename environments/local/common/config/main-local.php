<?php

return [
	'bootstrap' => [
		'debug',
	],
	'modules' => [
		'debug' => [
			'class' => 'yii\debug\Module',
			'allowedIPs' => ['*'],
			'panels' => [
				'queue' => \yii\queue\debug\Panel::class,
			],
		],
	],
	'components' => [
		'request' => [
			'cookieValidationKey' => ''
		],
	],
];
