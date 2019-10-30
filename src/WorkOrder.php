<?php

namespace classes;

class WorkOrder 
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

    public $actions = [self::ACTION_CANCEL, self::ACTION_WORK, self::ACTION_ACCEPT, self::ACTION_REFUSE];
    public $statuses = [self::STATUS_CANCEL, self::STATUS_WORK, self::STATUS_ACCEPT, self::STATUS_REFUSE, self::STATUS_NEW];


    public function getFollowingStatus($action)
    {
        if (in_array($action, $this->actions))
        {
            return $this->statuses[array_search($action, $this->actions)];
        }
        return '';
    }
    

    public function getActionOptions($status)
    {
        if ($status === self::STATUS_NEW)
        {
            return [self::ACTION_CANCEL, self::ACTION_WORK];
        }
        elseif ($status === self::STATUS_WORK)
        {
            return [self::ACTION_ACCEPT, self::ACTION_REFUSE];
        }
        return [];
    }
}
