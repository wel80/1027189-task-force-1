<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use TaskForce\Utils\TransmissionData;
use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;

$transmissionCategories = new TransmissionData(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'categories.csv', 
__DIR__.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'categories.sql', 'categories', ['name', 'icon']);
try {
    $transmissionCategories->transmission();
    print 'Файл "categories.sql" записан.';
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}

print '<br>';

$transmissionCities = new TransmissionData(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cities.csv', 
__DIR__.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'cities.sql', 'cities', ['city', 'lat', 'long']);
try {
    $transmissionCities->transmission();
    print 'Файл "cities.sql" записан.';
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}

print '<br>';

$transmissionOpinions = new TransmissionData(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'opinions.csv', 
__DIR__.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'opinions.sql', 'opinions', ['dt_add', 'rate', 'description']);
try {
    $transmissionOpinions->transmission();
    print 'Файл "opinions.sql" записан.';
}
catch (SourceFileException $e) {
    print $e->getMessage();
}
catch (FileFormatException $e) {
    print $e->getMessage();
}