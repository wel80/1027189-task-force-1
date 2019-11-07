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

    public static function isAvailable(int $userId, string $userRole): bool
    {
        if ($userId === Status::$customerId && $userRole === Status::ROLE_CUSTOMER) {
            return TRUE;
        }
        return FALSE;
    }
}