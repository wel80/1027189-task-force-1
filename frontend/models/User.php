<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $date_registration
 * @property int $city_id
 *
 * @property Opinion[] $opinions
 * @property Profile $profile
 * @property Reply[] $replies
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property City $city
 * @property UserSpecialization[] $userSpecializations
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'password', 'date_registration', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            [['email', 'name'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 64],
            [['date_registration'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'date_registration' => 'Date Registration',
            'city_id' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinion::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedTasks()
    {
        return $this->hasMany(Task::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepliedTasks()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializations()
    {
        return $this->hasMany(UserSpecialization::className(), ['user_id' => 'id']);
    }
}
