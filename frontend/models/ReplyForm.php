<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Reply;

class ReplyForm extends Model
{
    /**
     * @var int
     */
    public $rate;

    /**
     * @var string
     */
    public $comment;
    
    public function attributeLabels() : array
    {
        return [
            'rate' => 'Ваша цена',
            'comment' => 'Комментарий',
        ];
    }

    public function rules() : array
    {
        return [
            ['rate', 'integer', 'min' => 1,
                'message' => 'Укажите в этом поле целое число.',
                'tooSmall' => 'Укажите в этом поле целое число больше нуля.'
            ],
            ['comment', 'trim'],
            ['comment', 'string'],
        ];
    }

    public function createReply(int $taskId) : bool
    {
        $newReply = new Reply();
        $newReply->rate = $this->rate;
        $newReply->description = $this->comment;
        $newReply->author_id = Yii::$app->user->getId();
        $newReply->task_id = $taskId; 

        if ($newReply->save()) {
            return true;
        }
        return false;
    }
}