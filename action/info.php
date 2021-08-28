<?php

$stmt = $dbConnection->prepare('SELECT `link_id`,`link_telemetry`,`link_redirect`,`link_created` FROM `shortlinks` WHERE `link_shortcode` = :shortcode');
$stmt->execute(['shortcode' => $shortRequested]);

if($stmt->rowCount() === 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

$data = $stmt->fetch();

$stmt = $dbConnection->prepare('SELECT `telemetry_useragent` FROM `telemetry` WHERE `telemetry_link` = :linkid');
$stmt->execute(['linkid' => $data['link_id']]);

$accessCount = $stmt->rowCount();

if(empty($data)) {
    header("Location:".$requestedPath.'/');
    exit();
}

require_once TEMPLATE_DIR . '/page/info.php';