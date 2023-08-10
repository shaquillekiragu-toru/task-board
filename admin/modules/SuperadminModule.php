<?php

namespace admin\modules;

use yii\base\BootstrapInterface;

class SuperadminModule extends \TiSuperadmin\modules\admin\Module implements BootstrapInterface {

	public $layout = "superadmin";
	public $defaultRoute = 'site/index';

	public function bootstrap($app) {

		$app->getUrlManager()->addRules([
			'super/<environment:(local|staging|production)>' => 'super/environment/index',
			'super/<environment:(local|staging|production)>/<controller:[\w\-]+>' => 'super/<controller>/index',
			'super/<environment:(local|staging|production)>/<controller:[\w\-]+>/<action:[\w\-]+>' => 'super/<controller>/<action>',
			'super/<environment:(local|staging|production)>/<controller:[\w\-]+>/<action:[\w\-]+>/<id:[\w\-]+>' => 'super/<controller>/<action>',
			'super/<controller:[\w\-]+>/<action:[\w\-]+>/<id:[\w\-]+>' => 'super/<controller>/<action>',
		], false);
	}
}
