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
        $filters = $request->post('TasksFilterForm');

        $tasks = Task::find()
        ->joinWith('category')
        ->filterWhere([
            'task.status' => Status::STATUS_NEW,
            'category.icon' => $filters['category']
        ])
        ->andfilterWhere(['like', 'task.name', $filters['search']]);

        if ($filters['additionally'] && in_array('remoteWork', $filters['additionally'])) {
            $tasks = $tasks->andWhere([
                'task.latitude' => NULL,
                'task.longitude' => NULL
            ]);
        }

        if ($filters['period']) {
            $now = new \DateTime('now');
            $interval = new \DateInterval($filters['period']);
            $startDate = $now->sub($interval)->format('Y-m-d H:i:s');
            $tasks = $tasks->andWhere([
                '>', 
                'task.created_at', 
                $startDate
            ]);
        }

        $tasks = $tasks->orderBy(['created_at' => SORT_DESC])->all();

        $model = new TasksFilterForm();

        return $this->render('index', [
            'tasks' => $tasks, 
            'model' => $model
        ]);
    }
}