<?php

$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedPath = str_replace('/index.php','', $_SERVER['SCRIPT_NAME']);
$requestedUrl = str_replace($requestedPath, '', $requestedUrl);

router('/', function() use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection) {
    require_once ACTION_DIR.'/home.php';
}, 'POST|GET');

router('/([\w-]+)', function($shortRequested) use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection) {
    require_once ACTION_DIR.'/openUrl.php';
},'GET');

router('/([\w-]+)/telemetry', function($shortRequested) use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection) {
    require_once ACTION_DIR.'/telemetry.php';
},'GET');

echo router($requestedUrl);