<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Tasks\Status;

$followingStatus = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (Status::getActions() as $action) {
    printf($followingStatus, $action, Status::getFollowingStatus($action));
    print '<br>';
}

print '<br>';

$actionOptions = 'При статусе задания "%1s" доступны слудующие действия: "%2s"';
foreach (Status::getStatuses() as $status) {
    printf($actionOptions, $status, implode(', ', Status::getActionOptions($status)));
    print '<br>';
}
