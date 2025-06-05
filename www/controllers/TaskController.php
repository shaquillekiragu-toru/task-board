<?php

namespace www\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Task;

class TaskController extends Controller
{

    public function actionIndex()
    {
        $tasks = \common\models\Task::find()
            ->with('assignedUser')
            ->all();
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

    public function actionUpdate($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException('Task not found.');
        }

        if ($task->load(Yii::$app->request->post()) && $task->save()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('update', [
            'task' => $task
        ]);
    }

    public function actionDelete($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException('Task not found.');
        }

        $task->delete();
        return $this->redirect(['site/index']);
    }
}
