<?php

$stmt = $dbConnection->prepare("SELECT `link_redirect`,`link_telemetry`,`link_maxuse` FROM `shortlinks` WHERE `link_shortcode` = :code");
$stmt->execute(['code' => $shortRequested]);

if($stmt->rowCount() == 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

$data = $stmt->fetch();

$destination = $data['link_redirect'];

if($data['link_telemetry'] === 'TRUE') {

    if($data['link_maxuse'] > 0) {

        $stmt = $dbConnection->prepare("INSERT INTO ``");

    }

}

header("Location: ".$destination);