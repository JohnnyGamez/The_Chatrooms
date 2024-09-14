<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Change Avatar</title>
    <link rel="icon" type="image/x-icon" href="imgs/Chatrooms-logo.png">
</head>
<body>
    
    <?php if ($_SERVER["REQUEST_METHOD"] === 'POST') { 
        
        require("includes/navBar.php");
        
        ?>

        <div style="margin-top: 50px" class="loginForm">
    <form action="includes/changeAvatar.inc.php" method="post" enctype="multipart/form-data">
    
        <label for="newAvatar">Upload A New Avatar Image</label>
        <br>
        <input type="file" name="updateAvatar" id="updateAvatar" >
        <br>
        <br>
        <div class="center">
            <button>Update Avatar</button>
        </div>

    </form>
</div>

    <?php } else {

        header("Location: Signinup.php?page=login");

    } ?>


</body>
</html>