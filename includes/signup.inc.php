<?php


if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $username = $_POST["signupusername"];
    $pwd = $_POST["signuppwd"];
    $email = $_POST["email"];
    
    $filename = $_FILES['accounticon']['name'];
    $tmpname  = $_FILES['accounticon']['tmp_name'];
    $filesize = $_FILES['accounticon']['size'];
    $filetype = $_FILES['accounticon']['type'];

    

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_control.inc.php';
        
        // ERROR HANDLERS

        $errors = [];

        if (!isVaildFileType($filetype)) {

            $errors["wrongImgType"] = "Only Submit PNG, JPG, JPEG, or GIF";

        }

        if (isOverMaxSize($filesize)) {

            $errors["fileToBig"] = "Max File Size: 5MB";

        }
        
        if (isInputEmpty($username, $pwd, $email, $filetype)) {

            $errors["emptyInput"] = "Fill in all the fields!";

        }

        if (!isVaildEmail($email)) {

            $errors["invaildEmail"] = "Invailed Email";

        }

        if (isUsernameTaken($pdo, $username)) {

            $errors["usernameTaken"] = "Username already taken";

        }

        if (isEmailRegistered($pdo, $email)) {

            $errors["emailTaken"] = "Email already taken";

        }

        require_once 'config_session.inc.php';

        if ($errors) {

            $_SESSION["errorsSignup"] = $errors;

            $signupData = [

                "username" => $username,
                "email" => $email

            ];

            $_SESSION["signupFailedData"] = $signupData;

            header("Location: ../Signinup.php?page=signup");

            die();

        }

        createUser($pdo, $username, $pwd, $email, $tmpname, $filename);

        $pdo = null;
        $stmt = null;

        header("Location: ../Signinup.php?page=login");

        die();
    
    } catch (PDOException $e) {

        die("Query Failed: " . $e->getMessage());

    }

} else {

    header("Location: ../index.php");

    die();

}