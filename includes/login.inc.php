<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $username = $_POST["loginusername"];
    $pwd = $_POST["loginpwd"];

    try {

        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_control.onc.php';

        // error handlers

        $errors = [];

        if (isInputEmpty($username, $pwd)) {

            $errors["emptyInput"] = "Fill in all the fields!";

        }
        
        $result = getUser($pdo, $username);

        if (isUsernameWrong($result) && !isInputEmpty($username, $pwd)) {

            $errors["usernameWrong"] = "This Username Is Not Registered! Try signing up first.";

        };

        if (!isUsernameWrong($result) && isPasswordWrong($pwd, $result["pwd"])) {

            $errors["passwordWrong"] = "Incorrect Password!";

        };

        require_once 'config_session.inc.php';

        if ($errors) {

            $_SESSION["errorsLogin"] = $errors;

            header("Location: ../Signinup.php?page=login");

            die();

        };

        $newSessionId = session_create_id();

        $sessionId = $newSessionId . "_" . $result["id"];

        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["last_regeneration"] = time();

        $_SESSION["logedIn"] = "YES";

        header("Location: ../chat.php");
        
        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {

        die("Query Failed: " . $e->getMessage());

    };

} else {

    header("location: ../index.php");
    die();

};