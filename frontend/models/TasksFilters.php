<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\TasksFilterForm;

class TasksFilters extends \yii\db\ActiveQuery
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksFilters(Model $model)
    {
        return $this
        ->filterByCategories($model->categories)
        ->filterByRemoteWork($model->additionally)
        ->filterByPeriod($model->period)
        ->filterBySearch($model->search);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByCategories($categories)
    {
        if ($categories) {
            return $this->andWhere(['category.icon' => $categories]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByRemoteWork($additionally)
    {
        if ($additionally && in_array(TasksFilterForm::TYPE_REMOTE_WORK, $additionally)) {
            return $this->andWhere([
                'task.latitude' => NULL,
                'task.longitude' => NULL
            ]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByPeriod($period)
    {
        if ($period) {
            switch ($period) {
                case TasksFilterForm::PERIOD_ALL_TIME :
                    $interval = 'P10Y';
                break;
                case TasksFilterForm::PERIOD_LAST_DAY :
                    $interval = 'PT24H';
                break;
                case TasksFilterForm::PERIOD_LAST_WEEK :
                    $interval = 'P7D';
                break;
                case TasksFilterForm::PERIOD_LAST_MONTH :
                    $interval = 'P30D';
                break;

            }
            $now = new \DateTime('now');
            $interval = new \DateInterval($interval);
            $startDate = $now->sub($interval)->format('Y-m-d H:i:s');
            return $this->andWhere(['>', 'task.created_at', $startDate]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterBySearch($search)
    {
        if ($search) {
            return $this->andWhere(['like', 'task.name', $search]);
        }
        return $this;
    }
}
