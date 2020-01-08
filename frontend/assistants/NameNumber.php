<?php

namespace frontend\assistants;

class NameNumber
{
    /**
     * @return string
     */
    public static function forCountTasks(int $number)
    {
        $mod10 = $number % 10;
        $mod100 = $number % 100;
        
        if($mod100 >= 11 && $mod100 <= 20) {
            return $number.' заданий';
        }

        if($mod10 > 5) {
            return $number.' заданий';
        }

        if($mod10 === 1) {
            return $number.' задание';
        }

        if($mod10 >= 2 && $mod10 <= 4) {
            return $number.' задания';
        }

        return $number.' заданий';
    }
} 