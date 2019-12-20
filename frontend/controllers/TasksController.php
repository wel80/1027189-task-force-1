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
        $tasks = Task::find()
        ->with('category')
        ->where(['status' => Status::STATUS_NEW])
        ->orderBy(['created_at' => SORT_DESC])
        ->all();

        $model = new TasksFilterForm();

        $categoryAll = Category::find()->all();
        $categories = [];
        foreach($categoryAll as $category) {
            $categories[] = $category->name;
        }

        return $this->render('index', [
        'tasks' => $tasks, 
        'model' => $model, 
        'categories' => $categories
        ]);
    }
}