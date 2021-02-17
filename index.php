<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('vendor/autoload.php');
include('./classes/Person.php');
include('./classes/Mankind.php');

$mankind = Mankind::getInstance();
$mankind->loadFromCsv("file.csv");

//Foreach dle zadání
foreach($mankind->getPersonsArray() as $key => $value)
    echo "Uživatel s id $key má příjmení ".$value->getLastname()."<br>";

$user = $mankind->getPersonById(123);
echo "Stáří uživatele ".$user->getId()." je ".$user->getAgeInDays()." dní";