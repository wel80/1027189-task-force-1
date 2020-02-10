<?php

namespace TaskForce\Tasks;
use TaskForce\Tasks\Actions\CancelAction;
use TaskForce\Tasks\Actions\OfferAction;
use TaskForce\Tasks\Actions\WorkAction;
use TaskForce\Tasks\Actions\AcceptAction;
use TaskForce\Tasks\Actions\RefuseAction;
use TaskForce\Tasks\Exceptions\InvalidStatusException;
use TaskForce\Tasks\Exceptions\InvalidActionException;
use TaskForce\Tasks\Exceptions\InvalidRoleException;

class Status 
{
    const ACTION_CANCEL = 'cancel';
    const ACTION_OFFER = 'offer';
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

    private $customerId;
    private $executorId;
    private $termExecution;
    private $currentStatus;


    protected static $actionsToStatuses = [
        CancelAction::class => self::STATUS_CANCEL,
        OfferAction::class => self::STATUS_NEW,
        WorkAction::class => self::STATUS_WORK,
        AcceptAction::class => self::STATUS_ACCEPT,
        RefuseAction::class => self::STATUS_REFUSE
    ];

    public function __construct(int $customerId, ? int $executorId, string $termExecution, string $currentStatus)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->termExecution = $termExecution;
        if (!in_array($currentStatus, self::getStatuses())) {
            throw new InvalidStatusException('Status "' . $currentStatus . '" not exists');
        }
        $this->currentStatus = $currentStatus;
    }
    

    public static function getActions() : array
    {
        return [CancelAction::class, OfferAction::class, WorkAction::class, AcceptAction::class, RefuseAction::class];
    }

    public static function getStatuses() : array
    {
        return [self::STATUS_CANCEL, self::STATUS_WORK, self::STATUS_ACCEPT, self::STATUS_REFUSE, self::STATUS_NEW];
    }

    public static function getAvailableRoles() : array
    {
        return [self::ROLE_CUSTOMER, self::ROLE_EXECUTOR];
    }


    public function getCustomerId() : int
    {
        return $this->customerId;
    }

    public function getExecutorId() : ? int
    {
        return $this->executorId;
    }

    public function getCurrentStatus() : string
    {
        return $this->currentStatus;
    }


    public static function getFollowingStatus(string $action) : string
    {
        if (!in_array($action, self::getActions())) {
            throw new InvalidActionException('Action "' . $action . '" not exists');
        }
        return self::$actionsToStatuses[$action];
    }
    

    public function getAvailableActions(int $userId, string $userRole) : array
    {
        if (!in_array($userRole, self::getAvailableRoles())) {
            throw new InvalidRoleException('Role "' . $userRole . '" not exists');
        }
        $actions = [];
        foreach (self::getActions() as $action) {
            if ($action::isAvailable($this, $userId, $userRole)) {
                $actions[] = $action::getName();
            }
        }
        return $actions;
    }
}
