<?php

require_once __DIR__.'/config/default.php';
require_once SCRIPT_DIR.'/database.php';
require_once SCRIPT_DIR.'/router.php';
require_once SCRIPT_DIR.'/TemplateEngine.php';

$templateEngine = new TemplateEngine();
$messages = [];

require_once SCRIPT_DIR.'/UrlGenerator.php';

$urlGenerator = new UrlGenerator($dbConnection);

require_once BASE_DIR.'/vendor/autoload.php';

require_once BASE_DIR.'/routes.php';