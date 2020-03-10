<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reply".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $text
 * @property string $status
 * @property int $chat_id
 *
 * @property Chat $chat
 * @property ChatFile[] $files
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['text', 'chat_id'], 'required'],
            [['updated_at', 'text', 'status'], 'string'],
            [['chat_id'], 'integer'],
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
            'updated_at' => 'Updated At',
            'text' => 'Text',
            'status' => 'Status',
            'chat_id' => 'Chat ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::className(), ['id' => 'chat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(ChatFile::className(), ['massage _id' => 'id']);
    }
}
