<?php

require_once __DIR__ . '/vendor/autoload.php';
use TaskForce\Utils\TransmissionData;
use TaskForce\Tasks\Exceptions\FileFormatException;
use TaskForce\Tasks\Exceptions\SourceFileException;

$transmissionCategories = new TransmissionData(__DIR__ . '\data\categories.csv', __DIR__ . '\sql\categories.sql', 'categories', ['name', 'icon']);
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

print '<br><br>';

$transmissionCities = new TransmissionData(__DIR__ . '\data\cities.csv', __DIR__ . '\sql\cities.sql', 'cities', ['city', 'lat', 'long']);
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

print '<br><br>';

$transmissionOpinions = new TransmissionData(__DIR__ . '\data\opinions.csv', __DIR__ . '\sql\opinions.sql', 'opinions', ['dt_add', 'rate', 'description']);
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