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

    public static function isAvailable($status, int $userId, string $userRole): bool
    {
        if ($userId === $status->customerId 
        && $userRole === $status::ROLE_CUSTOMER 
        && $status->currentStatus === $status::STATUS_NEW) {
            return true;
        }
        return false;
    }
}