<?php

$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedPath = str_replace('/index.php','', $_SERVER['SCRIPT_NAME']);
$requestedUrl = str_replace($requestedPath, '', $requestedUrl);

router('/', function() use ($requestedPath) {
    require_once TEMPLATE_DIR.'/page/home.php';
}, 'POST|GET');

echo router($requestedUrl);