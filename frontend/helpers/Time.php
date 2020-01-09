<?php

namespace frontend\helpers;
use Yii;

class Time 
{
    /**
     * @return string
     */
    public static function durationToNow(string $referenceDate) : string
    {
        $referencePoint = new \DateTime($referenceDate);
        $now = new \DateTime('now');
        $elapsedTime = $referencePoint->diff($now);
        if ($elapsedTime->y > 0) {
            return Yii::$app->formatter->asDuration($elapsedTime->format('P%yY'));
        } elseif ($elapsedTime->m > 0) {
            return Yii::$app->formatter->asDuration($elapsedTime->format('P%mM'));
        }
        return Yii::$app->formatter->asDuration($elapsedTime->format('P%dD'));
    }
}