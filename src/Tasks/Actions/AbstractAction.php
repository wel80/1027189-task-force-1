<?php

namespace TaskForce\Tasks\Actions;

abstract class AbstractAction
{
    abstract public static function getTitle(): string;
    abstract public static function getName(): string;
    abstract public function isAvailable(int $userId, string $userRole, object $instance): bool;
}