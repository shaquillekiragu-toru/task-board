<?php

$config = [
	'name' => APP_NAME,
	'sourceLanguage' => 'en',
	'defaultRoute' => '/site/index',
	'bootstrap' => [
		'log',
		's3bucket',
		// 'super',
		'queue',
		'TiImage\bootstrap\ImageBootstrap',
		'TiFile\bootstrap\FileBootstrap',
		'TiVideo\bootstrap\VideoBootstrap',
	],
	'modules' => [
		// 'super' => [
		// 	'class' => 'TiSuperadmin\modules\rest\Module',
		// ],
	],
	'components' => [
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'sourceLanguage' => 'en-GB',
					'basePath' => '@common/translations',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
					],
					'on missingTranslation' => function ($event) {
						$message = $event->message;

						$message = str_replace('_', ' ', $message);
						$message = str_replace('-', ' ', $message);
						$message = ucwords($message);

						$event->translatedMessage = $message;
					},
				],
			],
		],
		'authClientCollection' => [
			'class' => 'yii\authclient\Collection',
			'clients' => [
				'google' => [
					'class' => 'yii\authclient\clients\Google',
					'returnUrl' => THIS_MODULE . '/site/auth?authclient=google',
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=' . RDS_HOST . ';dbname=' . ENVIRONMENT,
			'username' => RDS_USERNAME,
			'password' => RDS_PASSWORD,
			'charset' => 'utf8',
		],
		'session' => [
			'class' => 'yii\web\DbSession',
			'name' => APP_SLUG . '_' . ENVIRONMENT,
			'cookieParams' => [
				'path' => '/',
				'domain' => DOMAIN,
			],
		],
		'queue' => [
			'class' => \yii\queue\db\Queue::class,
			'db' => 'db',
			'tableName' => 'queue',
			'channel' => 'default',
			'mutex' => \yii\mutex\MysqlMutex::class,
			'as log' => \yii\queue\LogBehavior::class
		],
		'user' => [
			'class' => 'yii\web\User',
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'loginUrl' => '/site/login',
		],
		'log' => [
			'traceLevel' => 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => [
						'error',
						'warning',
						'info',
						'trace',
						'profile',
					],
				],
			],
		],
		'jwt' => [
			'class' => \sizeg\jwt\Jwt::class,
			'key' => 'b9qdy-75t78-ugfht-yo8tu-ho38u-th7t9',
		],
		's3bucket' => [
			'class' => \frostealth\yii2\aws\s3\Storage::class,
			'defaultAcl' => \frostealth\yii2\aws\s3\Storage::ACL_PUBLIC_READ,
			'bucket' => BUCKET_NAME,
			'credentials' => [
				'key' => AWS_KEY,
				'secret' => AWS_SECRET,
			],
			'region' => AWS_REGION,
		],
		'slack' => [
			'class' => \common\components\SlackComponent::class,
		],
		'email' => [
			'class' => \common\components\EmailComponent::class,
		],
		'assetManager' => [
			'appendTimestamp' => true,
			'linkAssets' => true,
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => false,
			'rules' => [
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
			],
		],
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
];

return $config;
