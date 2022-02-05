<?php
require(__DIR__ . "/vendor/autoload.php");
use Blackfoxtr\EkranAgent\EkranAgent;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$d = new EkranAgent;
print_r($d->stats());
