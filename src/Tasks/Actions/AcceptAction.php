<?php

namespace TaskForce\Tasks\Actions;
use TaskForce\Tasks\Status;

class AcceptAction extends AbstractAction
{
    public static function getTitle(): string
    {
        return 'Принять';
    }

    public static function getName(): string
    {
        return Status::ACTION_ACCEPT;
    }

    public static function isAvailable($status, int $userId, string $userRole): bool
    {
        if ($userId === $status->customerId
        && $userRole === $status::ROLE_CUSTOMER
        && $status->currentStatus === $status::STATUS_WORK) {
            return true;
        }
        return false;
    }
}