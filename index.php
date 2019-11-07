<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Tasks\Status;

$followingStatus = 'При выборе действия "%1s" задание перейдёт в статус "%2s"';
foreach (Status::getActions() as $action) {
    printf($followingStatus, $action::getTitle(), Status::getFollowingStatus($action));
    print '<br>';
}

print '<br>';

Status::$currentStatus = 'new';
$user = ['id' => 1, 'role' => 'customer'];
print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($user));

print '<br><br>';

Status::$currentStatus = 'new';
$user = ['id' => 1, 'role' => 'executor'];
print 'Статус задания - Новое, Пользователь - автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($user));

print '<br><br>';

Status::$currentStatus = 'new';
$user = ['id' => 2, 'role' => 'executor'];
print 'Статус задания - Новое, Пользователь - не автор задания, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($user));

print '<br><br>';

Status::$currentStatus = 'work';
$user = ['id' => 1, 'role' => 'customer'];
print 'Статус задания - В работе, Пользователь - автор задания, Статус пользователя - Заказчик, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($user));

print '<br><br>';

Status::$currentStatus = 'work';
$user = ['id' => 2, 'role' => 'executor'];
print 'Статус задания - В работе, Пользователь - исполнитель, Статус пользователя - Исполнитель, <br> 
Доступные действия: ' . implode(', ', Status::getAvailableActions($user));