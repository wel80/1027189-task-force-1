<?php

namespace frontend\models;

use Yii;
use frontend\models\TasksFilterForm;

class TasksFilters extends \yii\db\ActiveQuery
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksFilters($filters)
    {
        if ($filters) {
            return $this
            ->filterByCategories($filters)
            ->filterByRemoteWork($filters)
            ->filterByPeriod($filters)
            ->filterBySearch($filters);
        }
        return $this;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByCategories(array $filters)
    {
        if ($filters['categories']) {
            return $this->andWhere(['category.icon' => $filters['categories']]);
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    private function filterByRemoteWork(array $filters)
    {
        if ($filters['additionally'] && in_array(TasksFilterForm::TYPE_REMOTE_WORK, $filters['additionally'])) {
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
    private function filterByPeriod(array $filters)
    {
        if ($filters['period']) {
            switch ($filters['period']) {
                case 'allTime':
                    $interval = TasksFilterForm::PERIOD_ALL_TIME;
                break;
                case 'day':
                    $interval = TasksFilterForm::PERIOD_LAST_DAY;
                break;
                case 'week':
                    $interval = TasksFilterForm::PERIOD_LAST_WEEK;
                break;
                case 'month':
                    $interval = TasksFilterForm::PERIOD_LAST_MONTH;
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
    private function filterBySearch(array $filters)
    {
        if ($filters['search']) {
            return $this->andWhere(['like', 'task.name', $filters['search']]);
        }
        return $this;
    }
}
