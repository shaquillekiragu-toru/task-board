<?php

return [
	'user.passwordResetTokenExpire' => 3600 * 24,
	'maxFileUpload' => '12MB',
	'maxUploadSize' => (1024 * 1024 * 256),
	'cache' => 5,
	'recaptchaKey' => 'UNSET',
	'recaptchaSecret' => 'UNSET',
	's3-cdn' => 'https://cnd.example.com/cms-uploads/',
	's3-folder' => 'cms-uploads',
	'aws' => [
		'credentials' => [
			'key' => AWS_KEY,
			'secret' => AWS_SECRET,
		],
		'region' => AWS_REGION,
		'version' => 'latest'
	],
];
