<?php

namespace frontend\models;

use Yii;

class TasksFilterForm extends \yii\db\ActiveRecord
{
    public $category;
    public $additionally;
    public $period;
    public $search;
    
    public function attributeLabels()
    {
        return [
            'category' => 'Категории',
            'additionally' => 'Дополнительно',
            'period' => 'Период',
            'search' => 'Поиск по названию',
        ];
    }
}