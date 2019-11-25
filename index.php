<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use TaskForce\Utils\TransmissionData;
use TaskForce\Utils\Processings\FileRead;
use TaskForce\Utils\Processings\FileWrite;
use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;




$outputFilePath = sprintf('%s%sdata%scategories.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%scategories.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'category';
$columns = ['name' => 'name', 'icon' => 'icon'];
$transmissionCategories = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionCategories->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath); 
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%scities.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%scities.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'city';
$columns = ['city' => 'city', 'city_lat' => 'lat', 'city_long' => 'long'];
$transmissionCities = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionCities->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%sopinions.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%sopinions.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'opinion';
$columns = ['created_at' => 'dt_add', 
'rate' => 'rate',
'description' => 'description', 
'author_id' => 20, 
'task_id' => 10
];
$transmissionOpinions = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionOpinions->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%sprofiles.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%sprofiles.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'profile';
$columns = ['address' => 'address', 
'birthday' => 'bd', 
'about' => 'about', 
'phone' => 'phone', 
'skype' => 'skype',
'user_id' => 20
];
$transmissionProfiles = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionProfiles->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%sreplies.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%sreplies.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'reply';
$columns = ['created_at' => 'dt_add', 
'rate' => 'rate',
'description' => 'description', 
'author_id' => 20, 
'task_id' => 10
];
$transmissionReplies = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionReplies->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%stasks.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%stasks.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'task';
$columns = ['created_at' => 'dt_add', 
'category_id' => 'category_id', 
'description' => 'description', 
'expire' => 'expire', 
'name' => 'name', 
'address' => 'address', 
'budget' => 'budget', 
'task_lat' => 'lat', 
'task_long' => 'long',
'author_id' => 20
];
$transmissionTasks = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionTasks->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}




print '<br>';

$outputFilePath = sprintf('%s%sdata%susers.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$inputFilePath = sprintf('%s%ssql%susers.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileWrite = new FileWrite($inputFilePath);
$table = 'user';
$columns = ['email' => 'email',
'name' => 'name',
'password' => 'password', 
'date_registration' => 'dt_add',
'city_id' => 1108
];
$transmissionUsers = new TransmissionData($fileRead, $fileWrite, $table);
try {
    $transmissionUsers->transmission($columns);
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}