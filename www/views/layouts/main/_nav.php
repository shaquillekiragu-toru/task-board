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
			'label' => 'Dashboards',
			'active' => in_array($controller_id, ['mydashboard', 'dashboard']),
			'url' => WWW,
			'icon' => 'home',
			'children' => [
				[
					'label' => \Yii::t('app', 'my_dashboard'),
					'url' => WWW,
					'active' => $controller_id === 'mydashboard',
				],
				[
					'label' => \Yii::t('app', 'projects_to_date'),
					'url' => WWW . '/dashboard/projects-to-date',
					'active' => $controller_id === 'dashboard' && $action_id === 'prfojects-to-date',
				],
				[
					'label' => \Yii::t('app', 'weekly_summary'),
					'url' => WWW . '/dashboard/weekly-summary',
					'active' => $controller_id === 'dashboard' && $action_id === 'weekly-summary',
				],
				[
					'label' => \Yii::t('app', 'monthly_summary'),
					'url' => WWW . '/dashboard/monthly-summary',
					'active' => $controller_id === 'dashboard' && $action_id === 'monthly-summary',
				],
				[
					'label' => \Yii::t('app', 'project_monthly_summary'),
					'url' => WWW . '/dashboard/project-monthly-summary',
					'active' => $controller_id === 'dashboard' && $action_id === 'project-monthly-summary',
				],
				[
					'label' => \Yii::t('app', 'timings'),
					'url' => WWW . '/dashboard/timings',
					'active' => $controller_id === 'dashboard' && $action_id === 'timings',
				],
				[
					'label' => \Yii::t('app', 'maintenance'),
					'url' => WWW . '/dashboard/maintenance',
					'active' => $controller_id === 'dashboard' && $action_id === 'maintenance',
				],
				[
					'label' => \Yii::t('app', 'work'),
					'url' => WWW . '/dashboard/work',
					'active' => $controller_id === 'dashboard' && $action_id === 'work',
				],
				[
					'label' => \Yii::t('app', 'sales'),
					'url' => WWW . '/dashboard/sales',
					'active' => $controller_id === 'dashboard' && $action_id === 'sales',
				],
				[
					'label' => \Yii::t('app', 'project_management'),
					'url' => WWW . '/dashboard/project-management',
					'active' => $controller_id === 'dashboard' && $action_id === 'project_management',
				],
				[
					'label' => \Yii::t('app', 'schedule'),
					'url' => WWW . '/dashboard/schedule',
					'active' => $controller_id === 'site' && $action_id === 'schedule',
				],
				[
					'label' => \Yii::t('app', 'chat with alan (Pre alpha)'),
					'url' => WWW . '/chat',
					'active' => $controller_id === 'chat' && $action_id === 'chat',
				],
			]
		],
		[
			'label' => \Yii::t('app', 'projects'),
			'url' => WWW . '/project',
			'active' => $controller_id === 'project',
			'icon' => 'calander'
		],
		[
			'label' => \Yii::t('app', 'tasks'),
			'url' => WWW . '/task',
			'active' => $controller_id === 'task',
			'icon' => 'clipboard'
		],
		[
			'label' => \Yii::t('app', 'imports'),
			'url' => WWW . '/import',
			'active' => $controller_id === 'import',
			'icon' => 'home'
		],
	];

	$breadcrumbs = $this->params['breadcrumbs'] ?? [];
	$actions = $this->params['actions'] ?? [];

	$cogmenu = [
		[
			'label' => \Yii::t('app', 'my_account'),
			'url' => WWW . '/user/view/' . Yii::$app->user->id
		],
		[
			'label' => \Yii::t('app', 'contacts'),
			'url' => WWW . '/contact'
		],
		[
			'label' => \Yii::t('app', 'organisations'),
			'url' => WWW . '/organisation'
		],
		[
			'label' => \Yii::t('app', 'categories'),
			'url' => WWW . '/category'
		],
		[
			'label' => \Yii::t('app', 'users'),
			'url' => WWW . '/user'
		],
		[
			'label' => \Yii::t('app', 'user_groups'),
			'url' => WWW . '/usergroup'
		],
		[
			'label' => \Yii::t('app', 'downloads'),
			'url' => WWW . '/download'
		],
		[
			'blank' => true
		],
		Yii::$app->user->can('admin') ? [
			'label' => \Yii::t('app', 'admin'),
			'url' => ADMIN
		] : null,
		[
			'blank' => true
		],
		[
			'blank' => true
		],
		[
			'label' => \Yii::t('app', 'log_out'),
			'url' => WWW . '/site/logout'
		],
	];
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
