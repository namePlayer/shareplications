<?php

use Da\QrCode\QrCode;

$createdOutputField = '';

if(isset($_POST['longUrlInput'])) {

    $origUrl = $_POST['longUrlInput'];
    $alerts = [];
    $generatedUrl = null;

    $enableTelemetry = 'false';
    $linkMaxUse = null;
    $password = '';
    $timestamp = NULL;
    $createdOutputFieldData = [];


    if($oneTimeTokenInvalid) {
        // $alerts[] = ['type' => 'danger', 'message' => 'Der Einmalschlüssel ist abgelaufen. Bitte versuche es erneut.'];
    }

    if(!filter_var($origUrl, FILTER_VALIDATE_URL)) {
        $alerts[] = ['type' => 'danger', 'message' => 'Die Zieladdresse ist ungültig. Pattern: <b>http(s)://zielhost</b>'];
    }

    if(str_contains($origUrl, $_SERVER['HTTP_HOST'])) {
        $alerts[] = ['type' => 'danger', 'message' => 'Wäre es nicht ziemlich Sinnfrei, einen Link zu erstellen, der zur selben Seite weiterzuleitet? Denk mal drüber nach.'];
    }

    $createdOutputFieldData['linkMaxuse'] = 'Kein Limit';
    if(isset($_POST['enableShortlinkTelemetry'])) {

        $enableTelemetry = 'true';

        if(isset($_POST['maximumShortlinkUses']) && is_int($_POST['maximumShortlinkUses']) && $_POST['maximumShortlinkUses'] > 0) {

            $linkMaxUse = $_POST['maximumShortlinkUses'];
            $createdOutputFieldData['linkMaxuse'] = $linkMaxUse;

        }

    }

    if(isset($_POST['linkAccessToken']) && !empty($_POST['linkAccessToken'])) {

        $password = password_hash($_POST['linkAccessToken'], PASSWORD_BCRYPT);

    }

    $createdOutputFieldData['linkExpiry'] = 'Nie';
    if(isset($_POST['shortlinkExpiryDate'], $_POST['shortlinkExpiryTime']) && !empty($_POST['shortlinkExpiryDate'] && !empty($_POST['shortlinkExpiryTime']))) {

        $date = $_POST['shortlinkExpiryDate'];
        $time = $_POST['shortlinkExpiryTime'];

        $timestring = DateTime::createFromFormat('Y-m-d  H:i', $date . ' ' . $time);
        if($timestring !== FALSE) {
            $timestamp = $timestring->getTimestamp();

            $createdOutputFieldData['linkExpiry'] = $date('d.m.Y H:i', $timestamp);

            if($timestamp < time()) {
                $timestamp = NULL;
            }
        }

        if(!isset($timestamp) || $timestamp === NULL) {
            $alerts[] = ['type' => 'danger', 'message' => 'Der Zeitstempel ist aus irgendeinem Grund nicht generiert worden'];
        }

    }

    if(count($alerts) == 0) {
        $generatedUrl = $urlGenerator->addShortenUrl($origUrl, $enableTelemetry, $linkMaxUse, $password, $timestamp, '');
    }

    if($generatedUrl != NULL) {
        $alerts[] = ['type' => 'success', 'message' => 'Die Kurzurl wurde angelegt. Adresse: <b>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$generatedUrl.'</b>'];
        $createdOutputFieldData['linkUrl'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$generatedUrl;
        $createdOutputFieldData['destinationUrl'] = $origUrl;
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

            $createdOutputFieldData['base64Image'] = $base64;

        }

    }

    if(count($alerts) === 1) {
        $createdOutputField = $templateEngine->render('linkcreatedform', $createdOutputFieldData);
    }

    $messages = array_merge($messages, $alerts);

}

require_once TEMPLATE_DIR.'/page/home.php';