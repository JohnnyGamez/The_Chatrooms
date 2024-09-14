<?php

function getOldAvatar(object $pdo, $username) {
    
    $query = 'SELECT icon FROM users WHERE username = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

}

function updateUserAvatar(object $pdo,string $username, string $filename, string $tmpname) {

    $targetpath = '../imgs/uploadedAvatars/' . $filename;

    if (move_uploaded_file($tmpname, $targetpath)) {

    $query = 'UPDATE users SET icon = :icon WHERE username = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":icon", $filename); 
    $stmt->execute();

    }

}