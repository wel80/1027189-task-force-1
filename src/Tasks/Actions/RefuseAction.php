<?php

namespace TaskForce\Tasks\Actions;
use TaskForce\Tasks\Status;

class RefuseAction extends AbstractAction
{
    public static function getTitle(): string
    {
        return 'Отказаться';
    }

    public static function getName(): string
    {
        return Status::ACTION_REFUSE;
    }

    public function isAvailable(int $userId, string $userRole, object $instance): bool
    {
        if ($userId === $instance->executorId 
        && $userRole === $instance::ROLE_EXECUTOR 
        && $instance->currentStatus === $instance::STATUS_WORK) {
            return true;
        }
        return false;
    }
}