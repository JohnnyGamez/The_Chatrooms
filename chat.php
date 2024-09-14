<?php 

    require 'includes/chatmodel.inc.php';
    require 'includes/dbh.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>List Of Chats</title>
    <link rel="icon" type="image/x-icon" href="imgs/Chatrooms-logo.png">
</head>
<body>
    <?php include('includes/navBar.php'); 
    
    $userslist = getAllUsers($pdo);

    if (isset($_SESSION['user_username'])) {

        foreach ($userslist as $user) {

            $name = htmlspecialchars($user["username"]);
    
            if ($name !== $_SESSION['user_username']) {
    
                $email = htmlspecialchars($user["email"]);
            $icon = getOtherUsersAvatars($pdo, $name)[0]['icon'];
            $imgpath = "imgs/uploadedAvatars/".$icon;
            $defultimg = 'imgs/userIconPlaceholder.png';
    
            $namelength = (strlen($name)) * 2;
            $emaillength = strlen($email);
            
            $divwidth = 0;

            if ($namelength > $emaillength) {

                $divwidth = (ceil($namelength * 15) + 150) . 'px';

            } elseif ($emaillength > $namelength) {

                $divwidth = (ceil($emaillength * 13) + 150) . 'px';

            }
    
            echo "<div class='userbubble' style='width:$divwidth'>";
    
            if (!empty($icon)) {
    
                echo "<img class='AvatarBig' src='$imgpath' alt='User Icon'>";
    
            } else {
    
                echo "<img src='$defultimg' alt='User Icon'>";
    
            }
    
            $element = "<h3>$name</h3><p>$email</p><br>";
    
            echo $element;
    
            ?> 
            
            <form action="chatWithPerson.php#end" method="get">
    
                <?php echo "<input style='display: none;' value='$name' name='userWeAreChatingWith'>";
    
                echo "<button id='chat'>Chat With $name</button>";
    
                ?>
    
            </form>
            
            </div>
    
            <?php
    
    
            }
            
        };
        

    } else {

        header("Location: Signinup.php?page=login");
    }

    ?>

    
</body>
</html>

