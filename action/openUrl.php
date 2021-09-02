<?php

$stmt = $dbConnection->prepare("SELECT `link_id`,`link_redirect`,`link_telemetry`,`link_maxuse`,`link_password`,`link_expires` FROM `shortlinks` WHERE `link_shortcode` = :code");
$stmt->execute(['code' => $shortRequested]);

if($stmt->rowCount() == 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

$data = $stmt->fetch();

$destination = $data['link_redirect'];

if(!empty($data['link_password'])) {

    if(!isset($_GET['key'])) {
        header("Location:".$requestedPath.'/');
        exit();
    }

    $key = $_GET['key'];

    if(!password_verify($key, $data['link_password'])) {
        header("Location:".$requestedPath.'/');
        exit();
    }


}

if($data['link_expires'] <= time()) {
    header("Location:".$requestedPath.'/');
    exit();
}

if($data['link_telemetry'] === 'true') {

    if($data['link_maxuse'] > 0) {

        $stmt = $dbConnection->prepare('SELECT COUNT(*) FROM `telemetry` WHERE `telemetry_link` = :linkid');
        $stmt->execute(['linkid' => $data['link_id']]);

        if($stmt->fetchColumn() >= $data['link_maxuse']) {

            header("Location:".$requestedPath.'/');
            exit();

        }

    }

    $refferer = '';
    if(isset($_SERVER['HTTP_REFERER'])) {
        $refferer = $_SERVER['HTTP_REFERER'];
    }

    $stmt = $dbConnection->prepare("INSERT INTO `telemetry` SET `telemetry_link` = :linkid, `telemetry_useragent` = :useragent, `telemetry_date` = :time, `telemetry_refferer` = :refferer");
    $stmt->execute(['linkid' => $data['link_id'], 'useragent' => $_SERVER['HTTP_USER_AGENT'], 'time' => time(), 'refferer' => $refferer]);

}

header("Location: ".$destination);