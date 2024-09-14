<?php

declare(strict_types=1);

function isVaildFileType($filetype) {
    
    if ($filetype === "image/png" || $filetype === "image/jpg" || $filetype === "image/jpeg" || $filetype === "image/gif" || empty($filetype)) {

        return true;

    } else {

        return false;

    }

};

function isOverMaxSize($filesize) {

    if ($filesize > 5 * 1024 * 1024) {

        return true;

    }else {

        return false;

    }

};

function isInputEmpty(string $username, string $pwd, string $email, $filetype) {

    if (empty($username) || empty($pwd) || empty($email) || empty($filetype)) {

        return true;

    } else {

        return false;

    };

};

function isVaildEmail($email) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return true;

    } else {

        return false;

    };

};

function isUsernameTaken(object $pdo, string $username) {

    if (getUsername($pdo, $username)) {

        return true;

    } else {

        return false;

    };

};

function isEmailRegistered(object $pdo, string $email) {

    if (getEmail($pdo, $email)) {

        return true;

    } else {

        return false;

    };

};

function createUSer(object $pdo, string $username, string $pwd, string $email, $filetempnamne, $filename) {
    
    setUser($pdo, $username, $pwd, $email, $filetempnamne, $filename);

}
