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

    public $customerId = 0;
    public $executorId = 0;
    public $termExecution = '';
    public $currentStatus = '';


    protected static $actionsToStatuses = [
        CancelAction::class => self::STATUS_CANCEL,
        WorkAction::class => self::STATUS_WORK,
        AcceptAction::class => self::STATUS_ACCEPT,
        RefuseAction::class => self::STATUS_REFUSE
    ];

    public function __construct($customerId, $executorId, $termExecution, $currentStatus)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->termExecution = $termExecution;
        $this->currentStatus = $currentStatus;
    }

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
    

    public function getAvailableActions(int $userId, string $userRole, Status $instance) : array
    {
        $actions = [];
        foreach (self::getActions() as $class) {
            if ($action::isAvailable($userId, $userRole, $this)) {
                $actions[] = $action::getTitle();
            }
        }
        return $actions;
    }
}
