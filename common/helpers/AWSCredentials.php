<?php

namespace common\helpers;

use yii;
use Aws\Ses\SesClient;

class AWSCredentials {

	public static function buildConnectionSetup($region = null) {
		$config = Yii::$app->params['aws'];
		$config['region'] = $region == null ? $config['region'] : $region;
		$config['version'] = $config['version'] ?? 'latest';

		return $config;
	}

	public static function getSesClient() {
		$config = Yii::$app->params['aws'];
		$config = self::buildConnectionSetup($config['region']);
		return new SesClient($config);
	}
}
