<?php

declare(strict_types=1);

function outputUser() {

    if (isset($_SESSION['user_id'])) {

        echo $_SESSION['user_username'];

    } else {

        echo "No one logged in";

    }

};

function checkLoginErrors() {
    
    if (isset($_SESSION["errorsLogin"])) {

        $errors = $_SESSION["errorsLogin"];

        echo "<br>";

        foreach ($errors as $error) {

            echo '<p class="error">' . $error . '</p>';

            echo "<br>";

        }

        unset($_SESSION["errorsLogin"]);

    } elseif (isset($_GET['login']) && $_GET['login'] === "success") {

        echo '<p class="success">Login Success!</p>';

    };

}