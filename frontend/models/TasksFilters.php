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
    public function getTasksFilters(TasksFilterForm $model)
    {
        if ($model->validate()) {
            return $this
            ->filterByCategories($model)
            ->filterByRemoteWork($model)
            ->filterByPeriod($model)
            ->filterBySearch($model);
        }
        return $this;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByCategories(TasksFilterForm $model)
    {
        if ($model->categories) {
            return $this->andWhere(['category.icon' => $model->categories]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByRemoteWork(TasksFilterForm $model)
    {
        if ($model->additionally && in_array(TasksFilterForm::TYPE_REMOTE_WORK, $model->additionally)) {
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
    private function filterByPeriod(TasksFilterForm $model)
    {
        if ($model->period) {
            switch ($model->period) {
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
    private function filterBySearch(TasksFilterForm $model)
    {
        if ($model->search) {
            return $this->andWhere(['like', 'task.name', $model->search]);
        }
        return $this;
    }
}
