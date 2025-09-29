<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Database;

// Load config
$config = require __DIR__ . '/../config/config.php';

// Connect to the database (global variable)
$db = Database::connect($config['db']);
return $db;