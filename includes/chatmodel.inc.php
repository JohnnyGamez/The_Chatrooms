<?php

declare(strict_types=1);

function getAllUsers(object $pdo) {

    $query = 'SELECT username, email, icon FROM users';

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

};

function getOtherUsersAvatars(object $pdo, string $username) {

    $query = 'SELECT icon FROM users WHERE username = :username';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

};

function getMessagesToYou(object $pdo, string $username, string $otheruser_username) {
    $query = 'SELECT * FROM comments WHERE from_user = :from_user and to_user = :to_user';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":to_user", $username);
    $stmt->bindParam(":from_user", $otheruser_username);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

};

function getMessagesFromYou(object $pdo, string $username, string $otheruser_username) {
    $query = 'SELECT * FROM comments WHERE from_user = :from_user and to_user = :to_user';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":to_user", $otheruser_username);
    $stmt->bindParam(":from_user", $username);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

};

function getAllMessages(object $pdo, string $username, string $otheruser_username) {
    
    $toYou = getMessagesToYou($pdo, $username, $otheruser_username);

    $fromYou = getMessagesFromYou($pdo, $username, $otheruser_username);

    $allMessages = array_merge($toYou, $fromYou);

    if (empty($allMessages)) {

        return false;

    } else {

        return $allMessages;

    }

}

function getOtheruserAvatar(object $pdo, string $username) {
    
    $query = 'SELECT icon FROM users WHERE username = :username';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

}

function addMessageToDatabase(object $pdo, string $message, $from, $to) {

    $query = 'INSERT INTO comments (from_user, to_user, comment_text) Values (:from_user, :to_user, :comment_text);';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":comment_text", $message);

    $stmt->bindParam(":from_user", $from);

    $stmt->bindParam(":to_user", $to);

    $stmt->execute();
    
}
