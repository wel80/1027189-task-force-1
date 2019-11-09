<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Tasks\Status;

$followingStatus = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (Status::getActions() as $action) {
    assert(Status::getFollowingStatus($action) === Status::$actionsToStatuses[$action]);
    printf($followingStatus, $action::getTitle(), Status::getFollowingStatus($action));
    print '<br>';
}

print '<br>';

$userId = 1;
$userRole = 'customer';
$customerId = 1;
$executorId = 2;
$termExecution = '2020-01-31';
$currentStatus = 'new';
$statusOne = new Status($customerId, $executorId, $termExecution, $currentStatus);

print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', $statusOne->getAvailableActions($userId, $userRole, $statusOne));







/*print '<br><br>';

Status::$currentStatus = 'new';
$userId = 1; 
$userRole = 'executor';
print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($userId, $userRole));

print '<br><br>';

Status::$currentStatus = 'new';
$userId = 2; 
$userRole = 'executor';
print 'Статус задания - Новое, Пользователь - не автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($userId, $userRole));

print '<br><br>';

Status::$currentStatus = 'work';
$userId = 1; 
$userRole = 'customer';
print 'Статус задания - В работе, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($userId, $userRole));

print '<br><br>';

Status::$currentStatus = 'work';
$userId = 2; 
$userRole = 'executor';

print 'Статус задания - В работе, Пользователь - исполнитель, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($userId, $userRole));*/