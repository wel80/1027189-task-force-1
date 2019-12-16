<?php

namespace TaskForce\Utils\Processings;

class NextNumber
{
    private static $number = 0;

    public static function getNumber() : int
    {
        self::$number = self::$number + 1;
        return self::$number;
    }
}