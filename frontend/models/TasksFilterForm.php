<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Category;

class TasksFilterForm extends \yii\base\Model
{
    const TYPE_MY_CITY = 'my city';
    const TYPE_REMOTE_WORK = 'remote work';
    const PERIOD_ALL_TIME = 'all time';
    const PERIOD_LAST_DAY = 'one day';
    const PERIOD_LAST_WEEK = 'one week';
    const PERIOD_LAST_MONTH = 'one month';
    
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
            [['period', 'search'], 'string'],
            ['period', 'in', 'range' => [self::PERIOD_ALL_TIME, self::PERIOD_LAST_DAY, self::PERIOD_LAST_WEEK, self::PERIOD_LAST_MONTH]]
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
            self::PERIOD_ALL_TIME => 'За всё время',
            self::PERIOD_LAST_DAY => 'За день', 
            self::PERIOD_LAST_WEEK => 'За неделю', 
            self::PERIOD_LAST_MONTH => 'За месяц'
        ];
    }
}