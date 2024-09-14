<?php

declare(strict_types=1);



function getUsername(object $pdo, string $username) {

    $query = 'SELECT username FROM users WHERE username = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

}

function getEmail(object $pdo, string $email) {

    $query = 'SELECT username FROM users WHERE email = :email;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

};

function setUser(object $pdo, string $username, string $pwd, string $email, $icon, $iconname) {
    
    $targatpath = "../imgs/uploadedAvatars/".$iconname;

    if (move_uploaded_file($icon, $targatpath)) {

        $query = 'INSERT INTO users (username, pwd, email, icon) VALUES (:username, :pwd, :email, :icon);';

        $stmt = $pdo->prepare($query);

        $options = [

            'cost' => 12

        ];

        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $hashedpwd);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":icon", $iconname);
        $stmt->execute();

    } else {

        echo "File Failed To Upload. Please Retry Signing Up Later";

    }; 

}