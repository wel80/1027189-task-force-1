<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\TasksFilterForm;
use TaskForce\Tasks\Status;

class TasksController extends Controller
{
    public function actionIndex()
    {   
        $request = Yii::$app->request;
        $filters = $request->post('TasksFilterForm');
        $model = new TasksFilterForm();

        $tasks = Task::find()
        ->joinWith('category')
        ->where(['task.status' => Status::STATUS_NEW])
        ->getTasksFilters($filters)
        ->orderBy(['created_at' => SORT_DESC])
        ->all();

        return $this->render('index', [
            'filters' => $filters,
            'model' => $model,
            'tasks' => $tasks,
        ]);
    }
}