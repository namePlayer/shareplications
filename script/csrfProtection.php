<?php
$oneTimeTokenInvalid = false;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['csrfToken']) || ($_POST['csrfToken'] !== $_SESSION['csrfToken'])) {
        $oneTimeTokenInvalid = true;
    }
}

var_dump(array_key_exists('csrfToken', $_SESSION));

$_SESSION['csrfToken'] = $newToken;