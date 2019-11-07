<?php

namespace TaskForce\Tasks;
use TaskForce\Tasks\Actions\CancelAction;
use TaskForce\Tasks\Actions\WorkAction;
use TaskForce\Tasks\Actions\AcceptAction;
use TaskForce\Tasks\Actions\RefuseAction;

class Status 
{
    const ACTION_CANCEL = 'cancel';
    const ACTION_WORK = 'start';
    const ACTION_ACCEPT = 'accept';
    const ACTION_REFUSE = 'refuse';
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancelled';
    const STATUS_WORK = 'work';
    const STATUS_ACCEPT = 'done';
    const STATUS_REFUSE = 'failed';
    const ROLE_CUSTOMER = 'customer';
    const ROLE_EXECUTOR = 'executor';

    public static $customerId = 1;
    public static $executorId = 2;
    public static $termExecution = '2020-01-31';
    public static $currentStatus = '';


    protected static $actionsToStatuses = [
        CancelAction::class => self::STATUS_CANCEL,
        WorkAction::class => self::STATUS_WORK,
        AcceptAction::class => self::STATUS_ACCEPT,
        RefuseAction::class => self::STATUS_REFUSE
    ];

    protected static $statusesToActions = [
        self::STATUS_CANCEL => [],
        self::STATUS_WORK => [AcceptAction::class, RefuseAction::class],
        self::STATUS_ACCEPT => [],
        self::STATUS_REFUSE => [], 
        self::STATUS_NEW => [CancelAction::class, WorkAction::class]
    ];


    public static function getActions() : array
    {
        return [CancelAction::class, WorkAction::class, AcceptAction::class, RefuseAction::class];
    }


    public static function getStatuses() : array
    {
        return [self::STATUS_CANCEL, self::STATUS_WORK, self::STATUS_ACCEPT, self::STATUS_REFUSE, self::STATUS_NEW];
    }


    public static function getFollowingStatus(string $action) : string
    {
        assert(array_key_exists($action, self::$actionsToStatuses));
        return self::$actionsToStatuses[$action];
    }
    

    public static function getAvailableActions(array $user) : array
    {
        $actions = [];
        foreach (self::$statusesToActions[self::$currentStatus] as $action) {
            if ($action::isAvailable($user['id'], $user['role'])) {
                $actions[] = $action::getTitle();
            }
        }
        return $actions;
    }
}
