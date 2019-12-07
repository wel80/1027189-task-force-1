<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 *
 * @property UserSpecialization[] $userSpecializations
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['icon'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializations()
    {
        return $this->hasMany(UserSpecialization::className(), ['specialization_id' => 'id']);
    }
}
