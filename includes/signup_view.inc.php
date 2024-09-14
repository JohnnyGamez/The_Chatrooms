<?php

declare(strict_types=1);

function signupInputs() {
    
    if (isset($_SESSION["signupFailedData"]['username']) && !isset($_SESSION["errorsSignup"]['usernameTaken'])) {

        echo '<label for="signupusername">Username</label>';
        echo "<br>";
        echo '<input id="signupusername" name="signupusername" type="text" placeholder="Username" value="' . $_SESSION["signupFailedData"]['username'] .'">';
        echo '<br>';
        echo "<br>";
        

    } else {

        echo '<label for="signupusername">Username</label>';
        echo "<br>";
        echo '<input id="signupusername" name="signupusername" type="text" placeholder="Username">';
        echo '<br>';
        echo "<br>";
        

    }

    echo '<label for="signuppwd">Password</label>';
    echo "<br>";
    echo '<input id="signuppwd" name="signuppwd" type="password" placeholder="Password">';
    echo "<br>";
    echo "<br>";
    

    if (isset($_SESSION["signupFailedData"]['email']) && !isset($_SESSION["errorsSignup"]['emailTaken']) && !isset($_SESSION["errorsSignup"]['invaildEmail'])) {

        echo '<label for="email">Email</label>';
        echo "<br>";
        echo '<input id="email" name="email" type="text" placeholder="Email" value="' . $_SESSION["signupFailedData"]['email'] .'">';
        echo "<br>";
        echo "<br>";
        

    } else {

        echo '<label for="email">Email</label>';
        echo "<br>";
        echo '<input id="email" name="email" type="text" placeholder="Email">';
        echo "<br>";
        echo "<br>";
        

    }

    echo "<label for='accounticon'>Choose An Image File For You Account Icon</label>";
    echo "<br>";
    echo "<input type='file' name='accounticon' id='accounticon'>";
    echo "<br>";
    echo "<br>";

}

function checkSignupErrors() {
    
    if (isset($_SESSION['errorsSignup'])) {

        $errors = $_SESSION['errorsSignup'];

        echo "<br>";

        foreach ($errors as $error) {

            echo '<p class="error">' . $error . '</p>';

        }

        unset($_SESSION['errorsSignup']);

    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {

        echo "<br>";

        echo '<p class="success">Signup Success!</p>';

    };

};