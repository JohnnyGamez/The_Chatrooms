<?php

declare(strict_types=1);

function getUser(object $pdo, string $username) {

    $query = 'SELECT * FROM users WHERE id = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

};

function getUserAvatar(object $pdo, string $username) {

    $query = 'SELECT icon FROM users WHERE username = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;

}

function getMessagesFromMe(object $pdo, string $username) {

    $query = 'SELECT from_user FROM comments WHERE from_user = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $result;

};

function getMessagesToMe(object $pdo, string $username) {

    $query = 'SELECT to_user FROM comments WHERE to_user = :username;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return $result;

};