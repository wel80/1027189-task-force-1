<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "opinion".
 *
 * @property int $id
 * @property string $created_at
 * @property int|null $rate
 * @property string|null $description
 * @property int $author_id
 * @property int $task_id
 *
 * @property User $author
 * @property Task $task
 */
class Opinion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opinion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'author_id', 'task_id'], 'required'],
            [['rate', 'author_id', 'task_id'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'string', 'max' => 15],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'rate' => 'Rate',
            'description' => 'Description',
            'author_id' => 'Author ID',
            'task_id' => 'Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
