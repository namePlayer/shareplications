<?php

$stmt = $dbConnection->prepare("SELECT `link_redirect` FROM `shortlinks` WHERE `link_shortcode` = :code");
$stmt->execute(['code' => $shortRequested]);

if($stmt->rowCount() == 0) {
    header("Location:".$requestedPath.'/');
    exit();
}

$data = $stmt->fetch();

$destination = $data['link_redirect'];
var_dump($destination);

header("Location: ".$destination);