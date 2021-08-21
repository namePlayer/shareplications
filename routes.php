<?php

$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedPath = str_replace('/index.php','', $_SERVER['SCRIPT_NAME']);
$requestedUrl = str_replace($requestedPath, '', $requestedUrl);

router('/', function() use ($requestedPath, $templateEngine, $urlGenerator, $messages) {
    require_once ACTION_DIR.'/home.php';
}, 'POST|GET');

echo router($requestedUrl);