<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Category;

class TasksFilterForm extends \yii\base\Model
{
    /**
     * @var array
     */
    public $categories;

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
            'categories' => 'Категории',
            'additionally' => 'Дополнительно',
            'period' => 'Период поиска',
            'search' => 'Поиск по названию',
        ];
    }

    public function rules() : array
    {
        return [
            
        ];
    }

    public function getCategoryList() : array
    {
        $categoriesAll = Category::find()->all();
        return ArrayHelper::map($categoriesAll, 'icon', 'name');
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