<?php
namespace frontend\controllers;

use frontend\components\AbstractSecuredController;
use frontend\models\Task;
use frontend\models\Reply;
use TaskForce\Tasks\Status;
use yii\helpers\Url;
use yii\db\Exception;


class ReplyController extends AbstractSecuredController
{
    public function actionAccept(int $replyId)
    {
        $reply = Reply::findOne($replyId);
        if (!$reply) {
            throw new Exception("Отзыв $replyId не найден");
        }

        $task = Task::findOne($reply->task_id);
        if (!$task) {
            throw new Exception("Задание $reply->task_id не найдено");
        }

        $task->status = Status::STATUS_WORK;
        $task->executor_id = $reply->author_id;

        if ($task->save()) {
            return $this->redirect(Url::to(['tasks/view', 'id' => $task->id]));
        }
        throw new Exception("Не удалось изменить статус задания в базе данных");
    }

    
    public function actionDeny(int $replyId)
    {
        $reply = Reply::findOne($replyId);

        if (!$reply) {
            throw new Exception("Отзыв $replyId не найден");
        }

        $reply->status = Status::STATUS_REFUSE;

        if ($reply->save()) {
            return $this->redirect(Url::to(['tasks/view', 'id' => $reply->task_id]));
        }
        throw new Exception("Не удалось изменить статус отклика в базе данных");
    }    
}