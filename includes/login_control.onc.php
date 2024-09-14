<?php

function isUsernameWrong(bool|array $result) {

    if (!$result) {

        return true;

    } else {

        return false;

    }

};

function isPasswordWrong(string $pwd, string $hashedpwd) {

    if (!password_verify($pwd, $hashedpwd)) {

        return true;

    } else {

        return false;

    }

};

function isInputEmpty(string $username, string $pwd) {

    if (empty($username) || empty($pwd)) {

        return true;

    } else {

        return false;

    }

};
