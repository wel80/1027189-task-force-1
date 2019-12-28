<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Category;

class TasksFilterForm extends \yii\base\Model
{
    const TYPE_MY_CITY = 'my city';
    const TYPE_REMOTE_WORK = 'remote work';
    const PERIOD_ALL_TIME = 'P10Y';
    const PERIOD_LAST_DAY = 'PT24H';
    const PERIOD_LAST_WEEK = 'P7D';
    const PERIOD_LAST_MONTH = 'P30D';
    
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
            'period' => 'Период',
            'search' => 'Поиск по названию',
        ];
    }

    public function rules() : array
    {
        return [
            [['categories', 'additionally', 'period', 'search'], 'safe'],
            /*[['categories', 'additionally', 'period', 'search'], 'required', 'isEmpty' => function ($value) {
                return empty($value);
            }],*/
            [['period', 'search'], 'string'],
            ['period', 'in', 'range' => ['allTime', 'day', 'week', 'month']]
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
            self::TYPE_MY_CITY => 'Мой город', 
            self::TYPE_REMOTE_WORK => 'Удалённая работа'
        ];
    }

    public function getPeriodList() : array
    {
        return [
            'allTime' => 'За всё время',
            'day' => 'За день', 
            'week' => 'За неделю', 
            'month' => 'За месяц'
        ];
    }
}