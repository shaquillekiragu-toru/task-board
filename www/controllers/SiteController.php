<?php

namespace www\controllers;

class SiteController extends \TiCMS\controllers\WebController
{

	public function actionIndex()
	{
		$tasks = \common\models\Task::find()->all();
		$tasksByStatus = [];

		foreach ($tasks as $task) {
			$status = $task->status ?? 'To Do';
			if (!isset($tasksByStatus[$status])) {
				$tasksByStatus[$status] = [];
			}
			$tasksByStatus[$status][] = $task;
		}

		return $this->render('index', [
			'tasksByStatus' => $tasksByStatus
		]);
	}

	public function actionTest()
	{
		return $this->render('test');
	}
}
