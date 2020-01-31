<?php
namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use frontend\models\Task;
use frontend\models\TaskForm;
use frontend\models\FileForm;
use frontend\models\TasksFilterForm;
use frontend\components\AbstractSecuredController;
use TaskForce\Tasks\Status;
use yii\web\UploadedFile;
use yii\db\Exception;
use yii\helpers\Url;

class TasksController extends AbstractSecuredController
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

    
    public function actionCreate()
    {
        $taskForm = new TaskForm();

        if (Yii::$app->request->getIsPost() && $taskForm->load(Yii::$app->request->post())) {
            $taskForm->files = UploadedFile::getInstances($taskForm, 'files');
            if ($taskForm->validate()) {
                if ($taskForm->createTask(Yii::$app->user->getId())) {
                    return $this->redirect(Url::to(['tasks/view', 'id' => $taskForm->taskId]));
                }
                throw new Exception("Не удалось записать новое задание в базу данных");
            }
        }

        return $this->render('create', ['taskForm' => $taskForm]);
    }
}