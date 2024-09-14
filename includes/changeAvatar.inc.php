<?php 

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'changeAvatarModel.inc.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $oldAvatar = getOldAvatar($pdo, $_SESSION['user_username'])['icon'];

    $oldPath = '../imgs/uploadedAvatars/' . $oldAvatar;

    if (!empty($oldAvatar)) {

        unlink($oldPath);

    }

    $filename = $_FILES['updateAvatar']['name'];
    $filesize = $_FILES['updateAvatar']['size'];
    $filetype = $_FILES['updateAvatar']['type'];
    $tmp_name = $_FILES['updateAvatar']['tmp_name'];

    updateUserAvatar($pdo, $_SESSION['user_username'], $filename, $tmp_name);

    header("Location: ../chat.php");

};