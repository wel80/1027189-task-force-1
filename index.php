<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\WorkOrder;

$orderWork = new WorkOrder();

foreach (WorkOrder::getActions() as $action) {
    print 'При выборе действия "' . $action . '" задание перейдёт в статус "' . WorkOrder::getFollowingStatus($action) . '".<br>';
}

print '<br>';

foreach (WorkOrder::getStatuses() as $status) {
    print 'При статусе задания "' . $status . '" доступны слудующие действия: "';
    print_r (WorkOrder::getActionOptions($status));
    print '"<br>';
}
