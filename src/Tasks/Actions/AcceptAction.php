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

    public static function isAvailable(int $userId, string $userRole, Status $instance): bool
    {
        if ($userId === $instance->customerId
        && $userRole === $instance::ROLE_CUSTOMER
        && $instance->currentStatus === $instance::STATUS_WORK) {
            return true;
        }
        return false;
    }
}