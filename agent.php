<?php
require(__DIR__ . "/vendor/autoload.php");
use Blackfoxtr\EkranAgent\EkranAgent;
use Dotenv\Dotenv;
// We should load .env contents
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Creating a new Agent
$agent = new EkranAgent;
// We can feed the stats to database directly.
$agent->storeStats();