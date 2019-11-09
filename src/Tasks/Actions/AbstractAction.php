<?php

namespace TaskForce\Tasks\Actions;
use TaskForce\Tasks\Status;

abstract class AbstractAction
{
    abstract public static function getTitle(): string;
    abstract public static function getName(): string;
    abstract public static function isAvailable(int $userId, string $userRole, Status $instance): bool;
}