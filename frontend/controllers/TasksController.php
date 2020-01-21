<?php
namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use frontend\models\Task;
use frontend\models\TasksFilterForm;
use frontend\components\AbstractController;
use TaskForce\Tasks\Status;

class TasksController extends AbstractController
{
    public function actionIndex()
    {
        $model = new TasksFilterForm();
        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());
        }

        $tasks = Task::find()
        ->joinWith('category')
        ->where(['task.status' => Status::STATUS_NEW]);
        if ($model->validate()) {
            $tasks = $tasks->getTasksFilters($model);
        }
        $tasks = $tasks->orderBy(['task.created_at' => SORT_DESC])->all();

        return $this->render('index', [
            'model' => $model,
            'tasks' => $tasks
        ]);
    }


    public function actionView(int $id)
    {
        $task = Task::find()
        ->joinWith('category', 'author')
        ->where(['task.id' => $id])
        ->one();

        if (!$task) {
            throw new NotFoundHttpException("Задание $id не найдено");
        }

        return $this->render('show', ['task' => $task]);
    }
}