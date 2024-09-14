<div class="accountDropdown">

            <?php 
            
                $userAvatar = getUserAvatar($pdo, $_SESSION['user_username'])["icon"];
        
                $imgpath = "";

                if (!empty($userAvatar)) {

                 $imgpath = "imgs/uploadedAvatars/" . $userAvatar;

                } else {

                   $imgpath = "imgs/userIconPlaceholder.png";

                 }

            ?>

            <div class="logo">

                <?php echo "<img class='Avatar' src='$imgpath' alt='logo'>" ?>
                <h4 style="margin-left: 8px"><?php echo $_SESSION['user_username']; ?></h4>

            </div>   
            <h4 class="left">Account Created On:</h4>
            <br>
            <?php 

                $username = $_SESSION['user_id'];

                $userData = getUser($pdo, $username);

                $datecreated = $userData[0]['created_at'];

                    date_default_timezone_set("America/Halifax");

                    $time = strtotime($datecreated);

                    $accountage = time() - $time;

                    $accountage_years = floor($accountage/31536000);
                    $accountage -= $accountage_years * 31536000;

                    $accountage_days = floor($accountage/86400);
                    $accountage -= $accountage_years * 86400;

                    $accountage_hours = floor($accountage/3600);
                    $accountage -= $accountage_years * 3600;

                    $message = "(";

                    if ($accountage_years > 1) {
                       
                        if ($accountage_days > 0 || $accountage_hours > 0) {

                            $message = $message . " " . $accountage_years . " Years";

                        } else {

                            $message = $message . " " . $accountage_years . " Years";

                        };

                    } elseif ($accountage_years === 1) {

                        if ($accountage_days > 0 || $accountage_hours > 0) {

                            $message = $message . " " . $accountage_years . " Year";

                        } else {

                            $message = $message . " " . $accountage_years . " Year";

                        };

                    } else {

                        if ($accountage_days > 1) {

                            if ($accountage_hours > 0) {

                                $message = $message . " " . $accountage_days . " Days";

                            } else {

                                $message = $message . " " . $accountage_days . " Days";

                            };

                        } elseif ($accountage_days === 1) {

                            if ($accountage_hours > 0) {

                                $message = $message . " " . $accountage_days . " Day";

                            } else {

                                $message = $message . " " . $accountage_days . " Day";

                            };

                        } else {

                            if ($accountage_hours > 1) {

                                if ($accountage > 0) {

                                    $message = $message . " " . $accountage_hours . " Hours";
    
                                } else {
    
                                    $message = $message . " " . $accountage_hours . " Hours";
    
                                };

                            } elseif ($accountage_hours === 1) {

                                if ($accountage > 0) {

                                    $message = $message . " " . $accountage_hours . " Hour";
    
                                } else {
    
                                    $message = $message . " " . $accountage_hours . " Hour";
    
                                };

                            } else {

                                $message = $message . " <1 Hour";

                            }

                        };

                    }

                    $message = $message . " )";

                    $timeasdate = date('Y-m-d', $time);

                    echo "<p class='pad'>$timeasdate $message </p>";

                


                ?> 

                <br>
                <br>
                
                <h4 class="left">Messages From You:</h4>
                
                <?php

                $username = $_SESSION['user_username'];

                $messgesFromMe = getMessagesFromMe($pdo, $username);

                $messgesToMe = getMessagesToMe($pdo, $username);

                $fromCount = 0;

                $toCount = 0;

                if ($messgesFromMe !== false) {

                    foreach ($messgesFromMe as $messge) {

                        $fromCount += 1;
    
                    };

                };

                if ($messgesToMe !== false) {

                    foreach ($messgesToMe as $messge) {

                        $toCount += 1;
    
                    };

                };

                echo "<br> <p class='pad'>$fromCount</p>";
                
                ?> 
                
                <br>
                <br>

                <h4 class="left">Messages To You:</h4>
                
                <?php

                echo "<br> <p class='pad'>$toCount</p>";

            ?>

            <br>

            <form action="changeAvatar.php" method="post">

                <div class="center">
                    <button>Change Account Avatar</button>
                </div>
            </form>

            <br>

            <form action="includes/logout.inc.php" method="post">

                <div class="center">
                    <button>Logout</button>
                </div>
            </form>
            


        </div>