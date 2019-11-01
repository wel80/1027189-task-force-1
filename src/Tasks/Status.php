<?php

namespace TaskForce\Tasks;

class Status 
{
    const ACTION_CANCEL = 'cancel';
    const ACTION_WORK = 'respond';
    const ACTION_ACCEPT = 'accept';
    const ACTION_REFUSE = 'refuse';
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancelled';
    const STATUS_WORK = 'work';
    const STATUS_ACCEPT = 'done';
    const STATUS_REFUSE = 'failed';

    protected static $actionsToStatuses = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_WORK => self::STATUS_WORK,
        self::ACTION_ACCEPT => self::STATUS_ACCEPT,
        self::ACTION_REFUSE => self::STATUS_REFUSE
    ];

    protected static $statusesToActions = [
        self::STATUS_CANCEL => [],
        self::STATUS_WORK => [self::ACTION_ACCEPT, self::ACTION_REFUSE],
        self::STATUS_ACCEPT => [],
        self::STATUS_REFUSE => [], 
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_WORK]
    ];


    public static function getActions() : array
    {
        return [self::ACTION_CANCEL, self::ACTION_WORK, self::ACTION_ACCEPT, self::ACTION_REFUSE];
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
    

    public static function getActionOptions(string $status) : array
    {
        assert(array_key_exists($status, self::$statusesToActions));
        return self::$statusesToActions[$status];
    }
}
