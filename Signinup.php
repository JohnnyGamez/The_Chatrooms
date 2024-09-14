<?php

    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Signup or Login</title>
    <link rel="icon" type="image/x-icon" href="imgs/Chatrooms-logo.png">
</head>
<body>
    
<?php include('includes/navBar.php'); ?>

    <?php
    echo "<div></div>";
    if (!isset($_SESSION['user_id']) && isset($_GET['page']) && $_GET['page'] === "signup") { ?>

       <div class="signupForm">

        <h3>Signup</h3>

        <form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">

        <?php

         signupInputs()

        ?>
        <div class="center">
        <button>Signup</button>
        </div>
        </form>
        
    

    <?php checkSignupErrors(); ?> 
    </div>
    <div class="loginForm">

    <form action="Signinup.php?page=login" method="post">
        
        <div class="center">
        <button>Already Have An Account? Login Here.</button>
        </div>

    </form>

    </div>
    
    <?php } 

    ?>

    <h2>

    <?php

    if (isset($_GET['login']) && $_GET['login'] === "success") {

        outputUser();
        echo "<div></div>";
    
    };

    ?>

    </h2>

    <?php

    if (!isset($_SESSION['user_id'])&& isset($_GET['page']) && $_GET['page'] === "login") { ?>

    <div class="loginForm">
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post">

        <label for="loginusername">Username</label>
        <br>
        <input id="loginusername" type="text" name="loginusername" placeholder="Username">
        <br>
        <br>
        <label for="loginpwd">Password</label>
        <br>
        <input id="loginpwd" name="loginpwd" type="password" placeholder="Password">
        <br>
        <br>
        <div class="center">
            <button>Login</button>
        </div>
    </form>

    <?php checkLoginErrors(); 

    echo "</div>"; ?>

    <div class="loginForm">

    <form action="Signinup.php?page=signup" method="post">

        <div class="center">
            <button>Don't Have An Account? Sign Up Here.</button>
        </div>
    </form>

    </div>
    
    <?php } 
    
    
    ?>

<?php

if (isset($_SESSION['user_id'])) { ?>

    <form action="includes/logout.inc.php" method="post">

        <div class="center">
            <button>Logout</button>
        </div>
    </form>

<?php } 

?>
    
</body>
</html>