<?php

use www\models\Download;

$links = [];
$breadcrumbs = [];
$actions = [];
$cogmenu = [];

if (!Yii::$app->user->isGuest) {

	$controller_id = Yii::$app->controller->id;
	$action_id = Yii::$app->controller->action->id;

	$links = [
		[
			'label' => \Yii::t('app', 'tasks'),
			'url' => WWW . '/task',
			'active' => $controller_id === 'task',
			'icon' => 'clipboard'
		],
	];

	$breadcrumbs = $this->params['breadcrumbs'] ?? [];
	$actions = $this->params['actions'] ?? [];

	$cogmenu = [];
}

foreach ($links as $key => $value) {
	if (is_array($value)) {
		$links[$key]['label'] = ucwords($links[$key]['label']);
	} else {
		$links[$key] = ucwords($links[$key]);
	}
}

return [
	"links" => $links,
	"cogmenu" => $cogmenu,
	"breadcrumbs" => $breadcrumbs,
	"actions" => $actions,
	"search" => false
];
