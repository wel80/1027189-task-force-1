<?php

namespace TaskForce\Tasks\Exceptions;

class InvalidRoleException extends Exception
{
    public function getError() : string
    {
        return 'Роль пользователя с именем "' . $this->getMessage() . '" не существует.';
    }
}