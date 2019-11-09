<?php

namespace TaskForce\Tasks\Actions;

abstract class AbstractAction
{
    abstract public static function getTitle(): string;
    abstract public static function getName(): string;
    abstract public static function isAvailable($status, int $userId, string $userRole): bool;
}