<?php

namespace www\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\Task;
use yii\filters\AccessControl;

class TaskController extends \TiCMS\controllers\WebController
{
    /* @inheritdoc */
    // public function behaviors(): array
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => [
    //                         'index',
    //                         'create',
    //                         'update',
    //                         'delete'
    //                     ],
    //                     'allow' => true,
    //                     'roles' => ['admin']
    //                 ],
    //                 [
    //                     'actions' => ['*'],
    //                     'allow' => false
    //                 ],
    //             ],
    //         ]
    //     ];
    // }

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

    public function getAssignedUserId()
    {
        return Task::findOne(Yii::$app->user->id)->getAssignedUserId();
    }

    public function actionCreate(int $id = 1)
    {
        $task = new Task();

        if ($task->load(Yii::$app->request->post()) && $task->save()) {
            return $this->redirect(['task/index']);
        }

        return $this->render('create', [
            'task' => $task
        ]);
    }

    public function actionUpdate($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException('Task not found.');
        }

        if (!$task->isAssignedToCurrentUser()) {
            throw new ForbiddenHttpException('You are not allowed to update this task.');
        }

        if ($task->load(Yii::$app->request->post()) && $task->save()) {
            return $this->redirect(['task/index']);
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

        if (!$task->isAssignedToCurrentUser()) {
            throw new ForbiddenHttpException('You are not allowed to delete this task.');
        }
        $task->delete();
        Yii::$app->session->setFlash('success', 'Task deleted successfully.');

        return $this->redirect(['task/index']);
    }

    public function actionMyTest($id)
    {
        return "Hello World $id";
    }
}
