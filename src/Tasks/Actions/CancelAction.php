<?php

namespace TaskForce\Tasks\Actions;
use TaskForce\Tasks\Status;

class CancelAction extends AbstractAction
{
    public static function getTitle(): string
    {
        return 'Отменить';
    }

    public static function getName(): string
    {
        return Status::ACTION_CANCEL;
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