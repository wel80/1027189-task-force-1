<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Tasks\Status;

$followingStatus = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (Status::getActions() as $action) {
    assert(in_array(Status::getFollowingStatus($action), Status::getStatuses()));
    printf($followingStatus, $action::getTitle(), Status::getFollowingStatus($action));
    print '<br>';
}

print '<br>';
$customerId = 1;
$executorId = 2;
$termExecution = '2020-01-31';

$userId = 1;
$userRole = 'customer';
$currentStatus = 'new';
$statusOne = new Status($customerId, $executorId, $termExecution, $currentStatus);
assert(in_array(Status::ACTION_CANCEL, $statusOne->getAvailableActions($userId, $userRole)));
assert(in_array(Status::ACTION_WORK, $statusOne->getAvailableActions($userId, $userRole)));
print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', $statusOne->getAvailableActions($userId, $userRole));

print '<br><br>';

$userId = 1;
$userRole = 'executor';
$currentStatus = 'new';
$statusTwo = new Status($customerId, $executorId, $termExecution, $currentStatus);
assert(empty($statusTwo->getAvailableActions($userId, $userRole)));
print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', $statusTwo->getAvailableActions($userId, $userRole));

print '<br><br>';

$userId = 2;
$userRole = 'executor';
$currentStatus = 'new';
$statusThree = new Status($customerId, $executorId, $termExecution, $currentStatus);
assert(empty($statusThree->getAvailableActions($userId, $userRole)));
print 'Статус задания - Новое, Пользователь - не автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', $statusThree->getAvailableActions($userId, $userRole));

print '<br><br>';

$userId = 1;
$userRole = 'customer';
$currentStatus = 'work';
$statusFour = new Status($customerId, $executorId, $termExecution, $currentStatus);
assert(in_array(Status::ACTION_ACCEPT, $statusFour->getAvailableActions($userId, $userRole)));
print 'Статус задания - На исполнении, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', $statusFour->getAvailableActions($userId, $userRole));

print '<br><br>';

$userId = 2;
$userRole = 'executor';
$currentStatus = 'work';
$statusFive = new Status($customerId, $executorId, $termExecution, $currentStatus);
assert(in_array(Status::ACTION_REFUSE, $statusFive->getAvailableActions($userId, $userRole)));
print 'Статус задания - На исполнении, Пользователь - исполнитель, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', $statusFive->getAvailableActions($userId, $userRole));

print '<br><br>';
$date = new DateTime();
$date->setDate(2001, 1, 31);
print $date->format('d-m-Y');