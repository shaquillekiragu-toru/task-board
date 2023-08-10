<?php

$writtableFiles = ['scratch', 'rest/web/tmp', 'api/web/tmp'];
$assetsAndRuntimeModules = [];
$cookieValidationFiles = [];
$executableFiles = ['', 'yii', 'init'];
$symlinks = [];

foreach (explode(' ', MODULES) as $module) {
	array_push($assetsAndRuntimeModules, $module);
	array_push($writtableFiles, $module . '/runtime');
	array_push($writtableFiles, $module . '/runtime/logs');
	array_push($writtableFiles, $module . '/runtime/cache');
	array_push($writtableFiles, $module . '/runtime/queue');
	array_push($writtableFiles, $module . '/runtime/debug');
	array_push($writtableFiles, $module . '/web/assets');
	array_push($cookieValidationFiles, $module . '/config/main-local.php');
	array_push($executableFiles, $module . '/web/index.php');
}

return [
	'local' => [
		'path' => 'local',
		'clearAssetsAndRuntimes' => $assetsAndRuntimeModules,
		'setCookieValidationKey' => $cookieValidationFiles,
		'setExecutable' => $executableFiles,
		'setWritable' => $writtableFiles,
		'createSymlink' => $symlinks
	],
];
