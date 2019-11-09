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

    public function isAvailable(int $userId, string $userRole, object $instance): bool
    {
        if ($userId === $instance->customerId 
        && $userRole === $instance::ROLE_CUSTOMER 
        && $instance->currentStatus === $instance::STATUS_NEW) {
            return true;
        }
        return false;
    }
}