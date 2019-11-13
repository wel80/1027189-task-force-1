<?php

namespace TaskForce\Tasks\Exceptions;

class ActionException extends Exception
{
    public function getError() : string
    {
        return 'Передано несуществующее значение: ' . $this->getMessage();
    }
}