<?php

use Da\QrCode\QrCode;

$qrImageField = '';

if(isset($_POST['longUrlInput'])) {

    $origUrl = $_POST['longUrlInput'];
    $alerts = [];
    $generatedUrl = null;

    $enableTelemetry = 'false';
    $linkMaxUse = NULL;

    if(empty($origUrl)) {
        $alerts[] = ['type' => 'danger', 'message' => 'Die ursprüngliche URL darf nich leer sein!'];
    }

    if(str_contains($origUrl, $_SERVER['HTTP_HOST'])) {
        $alerts[] = ['type' => 'danger', 'message' => 'Wäre es nicht ziemlich Sinnfrei, einen Link zu erstellen, der zur selben Seite weiterzuleitet? Denk mal drüber nach.'];
    }

    if(isset($_POST['enableShortlinkTelemetry'])) {

        $enableTelemetry = 'true';

        if(isset($_POST['maximumShortlinkUses']) && $_POST['maximumShortlinkUses'] > 0) {

            $linkMaxUse = $_POST['maximumShortlinkUses'];

        }

    }

    if(count($alerts) == 0) {
        $generatedUrl = $urlGenerator->addShortenUrl($origUrl, $enableTelemetry, $linkMaxUse, '');
    }

    if($generatedUrl != NULL) {
        $alerts[] = ['type' => 'success', 'message' => 'Die Kurzurl wurde angelegt. Adresse: <b>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$generatedUrl.'</b>'];
    }

    if(count($alerts) != 1) {
        $alerts[] = ['type' => 'danger', 'message' => 'Unser System hat wohl zu viel TikTok geschaut und ist jetzt kaputt.'];
    }

    if(isset($_POST['toggleCreateQR'], $_POST['foregroundCreateQR'], $_POST['backgroundCreateQR']) && $generatedUrl != NULL) {
        $qrForeground = $_POST['foregroundCreateQR'];
        $qrBackground = $_POST['backgroundCreateQR'];

        list($redFore, $greenFore, $blueFore) = sscanf($qrForeground, "#%02x%02x%02x");
        list($redBack, $greenBack, $blueBack) = sscanf($qrBackground, "#%02x%02x%02x");

        $qrCode = (new QrCode($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$generatedUrl))
            ->setSize(250)
            ->setMargin(5)
            ->setForegroundColor($redFore, $greenFore, $blueFore, 0)
            ->setBackgroundColor($redBack, $greenBack, $blueBack, 0);

        $base64 = $qrCode->writeDataUri();

        if(!empty($base64)) {
            $qrImageField = $templateEngine->render('qrshare-form', ['base64Image' => $base64]);
        }

    }

    $messages = array_merge($messages, $alerts);

}

require_once TEMPLATE_DIR.'/page/home.php';