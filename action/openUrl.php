<?php

$errorCode = '';
$errorTitle = '';
$errorMessage = '';

$stmt = $dbConnection->prepare("SELECT `link_id`,`link_redirect`,`link_telemetry`,`link_maxuse`,`link_password`,`link_expires` FROM `shortlinks` WHERE `link_shortcode` = :code");
$stmt->execute(['code' => $shortRequested]);

if($stmt->rowCount() == 0) {
    $errorCode = '404';
    $errorTitle = 'Gekürzte URL nicht gefunden';
    $errorMessage = 'Diese URL wurde nicht gefunden. Möglicherweise hast du dich vertippt oder sie wurde gelöscht.';
}

$data = $stmt->fetch();

$destination = $data['link_redirect'];

if(!empty($data['link_password'])) {

    if(!isset($_GET['key'])) {
        $errorCode = '403';
        $errorTitle = 'Autorisierung benötigt';
        $errorMessage = 'Bei deiner Anfrage fehlt der Accesstoken, welcher am Ende mit dem Wert <b>?key=xxxxxx</b> angehängt';
    }

    $key = $_GET['key'];

    if(!password_verify($key, $data['link_password'])) {
        $errorCode = '403';
        $errorTitle = 'Autorisierung benötigt';
        $errorMessage = 'Bei deiner Anfrage fehlt der Accesstoken, welcher am Ende mit dem Wert <b>?key=xxxxxx</b> angehängt';
    }


}

if($data['link_expires'] > 0 && $data['link_expires'] !== NULL && $data['link_expires'] <= time()) {
    $errorCode = '410';
    $errorTitle = 'Link abgelaufen';
    $errorMessage = 'Die von dir aufgerufene URL ist bereits abgelaufen. Ganz dickes Sorry!';
}

if($data['link_telemetry'] === 'true') {

    if($data['link_maxuse'] > 0) {

        $stmt = $dbConnection->prepare('SELECT COUNT(*) FROM `telemetry` WHERE `telemetry_link` = :linkid');
        $stmt->execute(['linkid' => $data['link_id']]);

        if($stmt->fetchColumn() >= $data['link_maxuse']) {

            $errorCode = '410';
            $errorTitle = 'Link abgelaufen';
            $errorMessage = 'Die von dir aufgerufene URL ist bereits abgelaufen. Ganz dickes Sorry!';

        }

    }

    $refferer = '';
    if(isset($_SERVER['HTTP_REFERER'])) {
        $refferer = $_SERVER['HTTP_REFERER'];
    }

    $stmt = $dbConnection->prepare("INSERT INTO `telemetry` SET `telemetry_link` = :linkid, `telemetry_useragent` = :useragent, `telemetry_date` = :time, `telemetry_refferer` = :refferer");
    $stmt->execute(['linkid' => $data['link_id'], 'useragent' => $_SERVER['HTTP_USER_AGENT'], 'time' => time(), 'refferer' => $refferer]);

}

if(!preg_match('%https?://%ix', $destination)) {
    $destination = 'http://' . $destination;
}

if(!empty($errorTitle)) {
    http_response_code((int)$errorCode);
    require_once TEMPLATE_DIR.'/page/linkerror.php';
    exit();
}

header("Location: ".$destination);