<?php

namespace TaskForce\Tasks\Actions;
use TaskForce\Tasks\Status;

class WorkAction extends AbstractAction
{
    public static function getTitle(): string
    {
        return 'Откликнуться';
    }

    public static function getName(): string
    {
        return Status::ACTION_WORK;
    }

    public static function isAvailable(int $userId, string $userRole, Status $instance): bool
    {
        if ($userId === $instance->customerId 
        && $userRole === $instance::ROLE_CUSTOMER 
        && $instance->currentStatus === $instance::STATUS_NEW) {
            return true;
        }
        return false;
    }
}