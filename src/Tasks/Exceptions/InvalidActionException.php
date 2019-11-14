<?php

namespace TaskForce\Tasks\Exceptions;

class InvalidActionException extends Exception
{
    public function getError() : string
    {
        return 'Класс-действие с именем "' . $this->getMessage() . '" не существует.';
    }
}