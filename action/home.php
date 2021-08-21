<?php

if(isset($_POST['longUrlInput'])) {

    $origUrl = $_POST['longUrlInput'];
    $alerts = [];
    $generatedUrl = null;

    if(empty($origUrl)) {
        $alerts[] = ['type' => 'danger', 'message' => 'Die ursprüngliche '];
    }

    if(count($alerts) == 0) {
        $generatedUrl = $urlGenerator->addShortenUrl($origUrl, '');
    }

    if($generatedUrl != NULL) {
        $alerts[] = ['type' => 'success', 'message' => 'Die Kurzurl wurde angelegt. Adresse: <b>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$generatedUrl.'</b>'];
    }

    $messages = array_merge($messages, $alerts);

}

require_once TEMPLATE_DIR.'/page/home.php';