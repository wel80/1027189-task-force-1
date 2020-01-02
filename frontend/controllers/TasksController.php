<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Task;
use frontend\models\Reply;
use frontend\models\TasksFilterForm;
use TaskForce\Tasks\Status;

class TasksController extends Controller
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


    public function actionShow($id)
    {
        $task = Task::find()
        ->joinWith('category', 'author')
        ->where(['task.id' => $id])
        ->one();

        if (!$task) {
            throw new NotFoundHttpException("Задание не найдено");
        }

        $countTasks = Task::find()
        ->where(['task.author_id' => $task->author->id])
        ->count();

        $queryReplies = Reply::find()
        ->joinWith('author')
        ->where(['reply.task_id' => $id])
        ->orderBy(['reply.created_at' => SORT_DESC]);

        $countReplies = $queryReplies->count();
        $replies = [];
        if ($countReplies) {
            $replies = $queryReplies->all();
        }

        return $this->render('show', [
            'task' => $task,
            'countTasks' => $countTasks,
            'countReplies' => $countReplies,
            'replies' => $replies
        ]);
    }
}