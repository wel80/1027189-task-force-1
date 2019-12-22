<?php

namespace frontend\models;

use Yii;
use frontend\models\Category;

class TasksFilterForm extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $category;

    /**
     * @var array
     */
    public $additionally;

    /**
     * @var string
     */
    public $period;

    /**
     * @var string
     */
    public $search;
    
    public function attributeLabels() : array
    {
        return [
            'category' => 'Категории',
            'additionally' => 'Дополнительно',
            'period' => 'Период поиска',
            'search' => 'Поиск по названию',
        ];
    }

    public function getCategoryList() : array
    {
        $categoriesAll = Category::find()->all();
        $categoriesIcon = [];
        $categoriesName = [];
        foreach($categoriesAll as $category) {
            $categoriesIcon[] = $category->icon;
            $categoriesName[] = $category->name;
        }
        return array_combine($categoriesIcon, $categoriesName);
    }

    public function getAdditionallyList() : array
    {
        return [
            'myCity' => 'Мой город', 
            'remoteWork' => 'Удалённая работа'
        ];
    }

    public function getPeriodList() : array
    {
        return [
            'P10Y' => 'За всё время',
            'PT24H' => 'За день', 
            'P7D' => 'За неделю', 
            'P30D' => 'За месяц'
        ];
    }
}