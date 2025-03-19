<?php

$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePassword = '';
$databaseDbName = 'alta pro 65';

$destinatorEmail = '';

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'config.local.php')) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'config.local.php';
}

define("DATABASE_HOST", $databaseHost);
define("DATABASE_USER", $databaseUser);
define("DATABASE_PASSWORD", $databasePassword);
define("DATABASE_DB_NAME", $databaseDbName);

define("DESTINATOR_EMAIL", $destinatorEmail);