<?php
namespace frontend\controllers;

use yii\db\Query;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $query = new Query();
        $query->select(['t.name', 't.description', 't.budget', 't.latitude', 't.longitude', 't.created_at', 'category.name as category', 'category.icon as icon'])
        ->from('task t')
        ->join('INNER JOIN', 'category', 't.category_id = category.id')
        ->where(['executor_id' => null])
        ->orderBy(['t.created_at' => SORT_DESC]);
        $tasks = $query->all();
        
        return $this->render('index', ['tasks' => $tasks]);
    }
}