<?php

use TiNavbar\widgets\Nav;
use yii\helpers\Url;

$links = [];
$breadcrumbs = [];
$actions = [];
$cogmenu = [];

if (!Yii::$app->user->isGuest) {
	$active_id = $this->context->getUniqueId();

	$links = [
		[
			'label' => \Yii::t('app', 'Users'),
			'url' => ADMIN . '/user',
			'active' => $active_id === 'user',
			'icon' => 'icon-bubble'
		],
		[
			'label' => \Yii::t('app', 'Save'),
			'url' => ADMIN . '/save',
			'active' => $active_id === 'save',
			'icon' => 'icon-wrench'
		],
		[
			'label' => \Yii::t('app', 'Email'),
			'url' => ADMIN . '/email',
			'active' => $active_id === 'email',
			'icon' => 'icon-wrench'
		],
	];

	$breadcrumbs = $this->params['breadcrumbs'] ?? [];
	$actions = $this->params['actions'] ?? [];

	$cogmenu = [
		[
			'label' => \Yii::t('app', 'my_account'),
			'url' => ADMIN . '/user/view/' . Yii::$app->user->id
		],
		[
			'label' => \Yii::t('app', 'www'),
			'url' => WWW
		],
		['label' => '---'],
		[
			'label' => \Yii::t('app', 'goto superadmin'),
			'url' => ADMIN . '/super'
		]
	];
}

echo Nav::widget([
	"links" => $links,
	"cogmenu" => $cogmenu,
	"breadcrumbs" => $breadcrumbs,
	"actions" => $actions,
	"icon" => "icon-home2",
	"logo" => Url::toRoute('/img/logo-dark.png')
]);
