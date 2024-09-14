
<?php require_once 'includes/config_session.inc.php';
      require_once 'includes/navbarmodel.inc.php';
      require_once 'includes/dbh.inc.php'; ?>

<nav>

<div class="logo">

    <img src="imgs/Chatrooms-logo.png" alt="logo">
    <h3>Chatrooms</h3>

</div>    
<div class="hambuger">

    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>

</div>
<ul class="nav-links">

    <li><div><a href="index.php">Home</a></div></li>
    <li><div><a href="chat.php">Chats</a></div></li>
     
    
    <?php if (!isset($_SESSION['user_id'])) { ?>
        
        <li><a href="Signinup.php?page=login">Login</a></li>

    <?php } else {
        
        $userAvatar = getUserAvatar($pdo, $_SESSION['user_username'])["icon"];
        
        $imgpath = "";

        if (!empty($userAvatar)) {

            $imgpath = "imgs/uploadedAvatars/" . $userAvatar;

        } else {

            $imgpath = "imgs/userIconPlaceholder.png";


        }
        
        ?>

        <li><div class="dropdown"><div class="logo"><a class="accountmenu">Account</a><?php echo "<img class='Avatar' src='$imgpath' alt='logo'>" ?></div>
    
        <?php include('dropdown.php'); ?>
    
        </div></li>

    <?php } ?>

</ul>
</nav>