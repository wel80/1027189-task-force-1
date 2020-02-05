<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Task;
use frontend\models\Opinion;
use TaskForce\Tasks\Status;

class OpinionForm extends Model
{
    /**
     * @var string
     */
    public $result;

    /**
     * @var string
     */
    public $comment;
    
    /**
     * @var int
     */
    public $rate;
    
    public function attributeLabels() : array
    {
        return [
            'result' => 'Задание выполнено?',
            'comment' => 'Комментарий',
            'rate' => 'Оценка',
        ];
    }

    public function rules() : array
    {
        return [
            ['result', 'in', 'range' => [Status::STATUS_ACCEPT, Status::STATUS_REFUSE]],
            ['comment', 'trim'],
            ['comment', 'string'],
            ['rate', 'integer', 'min' => 1, 'max' => 5],
        ];
    }

    public function getResultList() : array
    {
        return [
            Status::STATUS_ACCEPT => 'Да', 
            Status::STATUS_REFUSE => 'Возникли проблемы',
        ];
    }

    public function createOpinion(Task $task) : bool
    {
        $newOpinion = new Opinion();
        $newOpinion->rate = $this->rate;
        $newOpinion->description = $this->comment;
        $newOpinion->author_id = Yii::$app->user->getId();
        $newOpinion->task_id = $task->id;
        $task->status = $this->result;

        if ($newOpinion->save() && $task->save()) {
            return true;
        }
        return false;
    }
}