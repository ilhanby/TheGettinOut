<?php

include "$_SERVER[DOCUMENT_ROOT]/includes/_config.php";
include "$_SERVER[DOCUMENT_ROOT]/includes/_database.php";
global $db; global $userx;
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'loginCont') {
    $data = " name = '{$_POST['name']}' AND passw = '{$_POST['passw']}' AND durum = '1' AND position = 'admin'";
    $userx = $db->_UserSingleFilter($data);
    foreach ($userx as $user) {
        $userx = $user;
    }
}

if (is_array($userx)) {
    if (is_null($userx) || empty($userx) || $userx == "")
        die(include "$_SERVER[DOCUMENT_ROOT]/pages/Others/error-500.php");
    else {
        $_SESSION['myUser'] = $userx;
        echo "ok";
    }
} else
    echo "hata";
