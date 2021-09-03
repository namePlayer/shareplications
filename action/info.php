<?php

$stmt = $dbConnection->prepare('SELECT `link_id`,`link_telemetry`,`link_redirect`,`link_created`,`link_expires`,`link_maxuse` FROM `shortlinks` WHERE `link_shortcode` = :shortcode');
$stmt->execute(['shortcode' => $shortRequested]);

if($stmt->rowCount() === 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

$data = $stmt->fetch();

$stmt = $dbConnection->prepare('SELECT `telemetry_id`,`telemetry_useragent`,`telemetry_date` FROM `telemetry` WHERE `telemetry_link` = :linkid');
$stmt->execute(['linkid' => $data['link_id']]);

$accessCount = $stmt->rowCount();
$accessList = '';

$expires = 'Nie';
if($data['link_expires']) {
    $expires = date('d.m.Y H:i', $data['link_expires']);
}

$uses = $accessCount;
if($data['link_maxuse'] > 0) {
    $uses = $accessCount . ' / ' . $data['link_maxuse'];
}

$accessListCount = 0;
while($row = $stmt->fetch() && $accessList < 15) {
    $accessList .= '<tr><th scope="row">'.$row['telemetry_id'].'</th><td>'.$row['telemetry_useragent'].'</td><td>'.date('d.m.Y H:i', $row['telemetry_date']).'</td></tr>';
}

if(empty($data)) {
    header("Location:".$requestedPath.'/');
    exit();
}

require_once TEMPLATE_DIR . '/page/info.php';