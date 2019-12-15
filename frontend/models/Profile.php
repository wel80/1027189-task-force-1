<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string|null $avatar
 * @property string|null $address
 * @property string|null $birthday
 * @property string|null $about
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $messenger
 * @property int $contacts_status
 * @property int $notification_new_message
 * @property int $notification_new_event_task
 * @property int $notification_new_review
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'contacts_status', 'notification_new_message', 'notification_new_event_task', 'notification_new_review'], 'integer'],
            [['birthday'], 'safe'],
            [['about'], 'string'],
            [['avatar', 'address', 'skype', 'messenger'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 30],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'avatar' => 'Avatar',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'about' => 'About',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'messenger' => 'Messenger',
            'contacts_status' => 'Contacts Status',
            'notification_new_message' => 'Notification New Message',
            'notification_new_event_task' => 'Notification New Event Task',
            'notification_new_review' => 'Notification New Review',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
