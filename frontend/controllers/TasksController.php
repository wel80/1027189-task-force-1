<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Task;
use TaskForce\Tasks\Status;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()
        ->with('category')
        ->where(['status' => Status::STATUS_NEW])
        ->orderBy(['created_at' => SORT_DESC])
        ->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}