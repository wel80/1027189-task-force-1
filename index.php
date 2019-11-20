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
$columns = ['name', 'icon'];
$transmissionCategories = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionCategories->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath); 
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
$columns = ['city', 'lat', 'long'];
$transmissionCities = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionCities->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
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
$columns = ['dt_add', 'rate', 'description'];
$transmissionOpinions = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionOpinions->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
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
$columns = ['address', 'bd', 'about', 'phone', 'skype'];
$transmissionProfiles = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionProfiles->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
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
$columns = ['dt_add', 'rate', 'description'];
$transmissionReplies = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionReplies->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
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
$columns = ['dt_add', 'category_id', 'description', 'expire', 'name', 'address', 'budget', 'lat', 'long'];
$transmissionTasks = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionTasks->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
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
$columns = ['email', 'name', 'password', 'dt_add'];
$transmissionUsers = new TransmissionData($fileRead, $fileWrite, $table, $columns);
try {
    $transmissionUsers->transmission();
    print sprintf('Файл "%s" записан', $inputFilePath);
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}