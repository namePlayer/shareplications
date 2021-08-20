<?php
require_once CONFIG_DIR.'/database.php';

try {
    $dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
} catch (PDOException $exception) {
    die('PDO Exception');
}