<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\WorkOrder;

$following_status = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (WorkOrder::getActions() as $action) {
    printf($following_status, $action, WorkOrder::getFollowingStatus($action));
    print '<br>';
}

print '<br>';

$action_options = 'При статусе задания "%1s" доступны слудующие действия: "%2s"';
foreach (WorkOrder::getStatuses() as $status) {
    printf($action_options, $status, implode(', ', WorkOrder::getActionOptions($status)));
    print '<br>';
}
