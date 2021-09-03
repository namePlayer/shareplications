<?php
$newToken = bin2hex(random_bytes(16));

$oneTimeTokenInvalid = false;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['csrfToken']) || ($_POST['csrfToken'] !== $_SESSION['csrfToken'])) {
        $oneTimeTokenInvalid = true;
    }
}
$_SESSION['csrfToken'] = $newToken;