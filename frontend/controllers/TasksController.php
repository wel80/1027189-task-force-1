<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\Category;
use frontend\models\TasksFilterForm;
use TaskForce\Tasks\Status;

class TasksController extends Controller
{
    public function actionIndex()
    {   
        $request = Yii::$app->request;
        if ($filters = $request->post('TasksFilterForm')) {
            $tasks = Task::find()
            ->joinWith('category')
            ->where(['task.status' => Status::STATUS_NEW])
            ->filterByCategories($filters)
            ->filterByRemoteWork($filters)
            ->filterByPeriod($filters)
            ->filterBySearch($filters)
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        } else {
            $tasks = Task::find()
            ->with('category')
            ->where(['task.status' => Status::STATUS_NEW])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        }

        $model = new TasksFilterForm();

        return $this->render('index', [
            'tasks' => $tasks, 
            'model' => $model
        ]);
    }
}