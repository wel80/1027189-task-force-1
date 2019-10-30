<?php

require_once('vendor/autoload.php');
use classes\WorkOrder;

$orderWork = new WorkOrder();

foreach($orderWork->actions as $val)
{
    print('При выборе действия "' . $val . '" задание перейдёт в статус "' . $orderWork->getFollowingStatus($val) . '".<br>');
}

print('<br>');

foreach($orderWork->statuses as $val)
{
    print('При статусе задания "' . $val . '" доступны слудующие действия: "');
    print_r($orderWork->getActionOptions($val));
    print('"<br>');
}
