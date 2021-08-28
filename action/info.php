<?php

$stmt = $dbConnection->prepare('SELECT `link_id`,`link_telemetry` FROM `shortlinks` WHERE `link_shortcode` = :shortcode');
$stmt->execute(['shortcode' => $shortRequested]);

if($stmt->rowCount() === 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

require_once TEMPLATE_DIR . '/page/info.php';