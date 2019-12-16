<?php


require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use TaskForce\Utils\TransmissionData;
use TaskForce\Utils\Processings\FileRead;
use TaskForce\Utils\Processings\FileWrite;
use TaskForce\Utils\TableModels\CategoryModel;
use TaskForce\Utils\TableModels\CityModel;
use TaskForce\Utils\TableModels\OpinionModel;
use TaskForce\Utils\TableModels\ProfileModel;
use TaskForce\Utils\TableModels\ReplyModel;
use TaskForce\Utils\TableModels\TaskModel;
use TaskForce\Utils\TableModels\UserModel;
use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;




$outputFilePath = sprintf('%s%sdata%scategories.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%scategories.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = CategoryModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath); 
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%scities.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%scities.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = CityModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%sopinions.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%sopinions.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = OpinionModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%sprofiles.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%sprofiles.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = ProfileModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);
try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%sreplies.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%sreplies.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = ReplyModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%stasks.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%stasks.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = TaskModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}

catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}


$outputFilePath = sprintf('%s%sdata%susers.csv', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$inputFilePath = sprintf('%s%ssql%susers.sql', __DIR__, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
$fileRead = new FileRead($outputFilePath);
$fileWrite = new FileWrite($inputFilePath);
$tableModel = UserModel::class;
$transmission = new TransmissionData($fileRead, $fileWrite, $tableModel);

try {
    $transmission->transmission();
    printf('Файл "%s" записан'.PHP_EOL, $inputFilePath);
}

catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}