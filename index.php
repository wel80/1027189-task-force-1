<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Tasks\Status;

$followingStatus = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (Status::getActions() as $action) {
    printf($followingStatus, $action, Status::getFollowingStatus($action));
    print '<br>';
}

print '<br>';

$user = [
    'status' => 'new',
    'id' => 1,
    'role' => 'customer'
];

print(implode(', ', Status::getAvailableActions($user)));
