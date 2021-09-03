<?php

$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedPath = str_replace('/index.php','', $_SERVER['SCRIPT_NAME']);
$requestedUrl = str_replace($requestedPath, '', $requestedUrl);

router('/', function() use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection, $oneTimeTokenInvalid) {
    require_once ACTION_DIR.'/home.php';
}, 'POST|GET');

router('/([\w-]+)', function($shortRequested) use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection) {
    require_once ACTION_DIR.'/openUrl.php';
},'GET');

router('/([\w-]+)/info', function($shortRequested) use ($requestedPath, $templateEngine, $urlGenerator, $messages, $dbConnection) {
    require_once ACTION_DIR . '/info.php';
},'GET');

$content = router($requestedUrl);

if(router($requestedUrl) === FALSE) {
    header("Location: ".$requestedPath);
    return;
}

echo router($requestedUrl);