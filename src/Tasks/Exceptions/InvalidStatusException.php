<?php

namespace TaskForce\Tasks\Exceptions;

class InvalidStatusException extends Exception
{
    public function getError() : string
    {
        return 'Статус задания с именем "' . $this->getMessage() . '" не существует.';
    }
}