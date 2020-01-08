<?php

namespace frontend\assistants;
use Yii;

class Time 
{
    /**
     * @return yii\i18n\Formatter
     */
    public static function durationToNow(string $referenceDate)
    {
        $referencePoint = new \DateTime($referenceDate);
        $now = new \DateTime('now');
        $elapsedTime = $referencePoint->diff($now);
        if ($elapsedTime->y > 0) {
            return Yii::$app->formatter->asDuration($elapsedTime->format('P%yY'));
        } elseif ($elapsedTime->m > 0) {
            return Yii::$app->formatter->asDuration($elapsedTime->format('P%mM'));
        } else {
            return Yii::$app->formatter->asDuration($elapsedTime->format('P%dD'));
        }
    }
}