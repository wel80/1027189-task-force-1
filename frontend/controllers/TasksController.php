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
        $fileForm = new FileForm();

        if (Yii::$app->request->getIsPost()) {
            $fileForm->file = UploadedFile::getInstance($fileForm, 'file');
            if ($taskForm->load(Yii::$app->request->post())
            && $taskForm->validate()
            && $fileForm->validate()) {
                $id_task = $taskForm->getNewTaskId();
                if ($fileForm->createFile($id_task)) {
                    return $this->redirect(Url::to(['tasks/view', 'id' => $id_task]));
                }
            }
        }

        return $this->render('create', [
            'taskForm' => $taskForm,
            'fileForm' => $fileForm,
        ]);
    }
}