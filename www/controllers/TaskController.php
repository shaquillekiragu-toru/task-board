<?php

namespace www\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Task;

class TaskController extends Controller
{
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
