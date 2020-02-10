<?php
namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use frontend\models\Task;
use frontend\models\User;
use frontend\models\TaskForm;
use frontend\models\ReplyForm;
use frontend\models\OpinionForm;
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

        $visitor = User::findOne(Yii::$app->user->getId());
        if (!$visitor) {
            throw new Exception("Пользователь в базе данных не найден");
        }

        $status = new Status ($task->author_id, $task->executor_id, $task->expire, $task->status);
        $actions = $status->getAvailableActions($visitor->id, $visitor->role);

        $replyForm = new ReplyForm();
        if (Yii::$app->request->getIsPost()
        && $replyForm->load(Yii::$app->request->post())
        && $replyForm->validate()) {
            if (!$replyForm->createReply($task->id)) {
                throw new Exception("Не удалось записать новый отклик в базу данных");
            }
        }

        $opinionForm = new OpinionForm();
        if (Yii::$app->request->getIsPost()
        && $opinionForm->load(Yii::$app->request->post())
        && $opinionForm->validate()) {
            if ($opinionForm->createOpinion($task)) {
                return $this->redirect(Url::to(['/']));
            }
            throw new Exception("Не удалось записать новый отзыв в базу данных");
        }

        return $this->render('show', ['task' => $task, 'actions' => $actions, 'replyForm' => $replyForm, 'opinionForm' => $opinionForm]);
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

    

    public function actionCancel(int $taskId)
    {
        $task = Task::findOne($taskId);

        if (!$task) {
            throw new Exception("Задание $taskId не найдено");
        }

        $task->status = Status::STATUS_CANCEL;

        if ($task->save()) {
            return $this->redirect(Url::to(['tasks/view', 'id' => $taskId]));
        }
        throw new Exception("Не удалось изменить статус задания в базе данных");
    }


    
    public function actionRefuse (int $taskId)
    {
        $task = Task::findOne($taskId);

        if (!$task) {
            throw new Exception("Задание $taskId не найдено");
        }

        $task->status = Status::STATUS_REFUSE;

        if ($task->save()) {
            return $this->redirect(Url::to(['tasks/view', 'id' => $taskId]));
        }
        throw new Exception("Не удалось изменить статус задания в базе данных");
    }
}