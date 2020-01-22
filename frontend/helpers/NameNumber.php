<?php

namespace frontend\helpers;

class NameNumber
{
    /**
     * @return string
     */
    public static function forCountTasks(int $number)
    {
        return \Yii::t(
            'app',
            '{n, plural, =0{Нет заданий} =1{1 задание} one{# задание} few{# задания} many{# заданий} other{# задания}}',
            ['n' => $number]
        );
    }
} 