<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/chatmodel.inc.php';

if(empty($_GET['userWeAreChatingWith'])) {
    header("Location: chat.php");
} 

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $text = htmlspecialchars($_POST['messagetext']);
    
    if (!empty($text)) {

        addMessageToDatabase($pdo, $text, $_SESSION['user_username'], htmlspecialchars($_GET['userWeAreChatingWith']));

    }

    $infotosend = "?userWeAreChatingWith=" . $_GET['userWeAreChatingWith'];

    header("Location: chatWithPerson.php$infotosend");

} 

function spliteDateTime($datetime) {

    $time = strtotime($datetime);
    
    $timeasdate = date('Y-m-j', $time);

    $year = substr($timeasdate, 0, 4);

    $monthnum = substr($timeasdate, 5, 2);

    $month = "";

    if ($monthnum === "01") {

        $month = "January";

    } elseif ($monthnum === "02") {

        $month = "February";

    }elseif ($monthnum === "03") {

        $month = "March";

    }elseif ($monthnum === "04") {

        $month = "April";

    }elseif ($monthnum === "05") {

        $month = "May";

    }elseif ($monthnum === "06") {

        $month = "June";

    }elseif ($monthnum === "07") {

        $month = "July";

    }elseif ($monthnum === "08") {

        $month = "August";

    }elseif ($monthnum === "09") {

        $month = "September";

    }elseif ($monthnum === "10") {

        $month = "October";

    }elseif ($monthnum === "11") {

        $month = "November";

    }elseif ($monthnum === "12") {

        $month = "December";

    }

    $day = substr($timeasdate, 8, 2);

    $date = $month . " " . $day . ", " . $year;

    $timeastime = date('H:i', $time);

    $array = [$date, $timeastime];

    return $array;
    
}

$otheruser = htmlspecialchars($_GET['userWeAreChatingWith']);
$otheruserAvatarName = getOtheruserAvatar($pdo, $otheruser)[0]['icon'];
$otheruserAvatarpath = "imgs/uploadedAvatars/" . $otheruserAvatarName;

function printAllMessages($pdo, $otheruser) {

    $messages = getAllMessages($pdo, $_SESSION['user_username'], $otheruser);

    $sortedmessages = [];

    if (!$messages) {



    } else {

        for ($i = 0; $i<sizeof($messages); $i++) {

            $sortedmessages[strtotime($messages[$i]['create_at'])]= $messages[$i];
    
        };

    };
    
    ksort($sortedmessages);
    
    if (!$messages) {

        ?> <p style="text-align: center; font-weight:bolder;">Type Something To Get Started</p> <?php

    } else {

        $currentdate = 0;

        foreach($sortedmessages as $message) {

            $datetime = $message['create_at'];

            $results = spliteDateTime($datetime);

            $date = $results[0];

            $time = $results[1];

            $Avatar = getOtheruserAvatar($pdo, $otheruser)[0]['icon'];

            $AvatarPath = "imgs/uploadedAvatars/" . $Avatar;

            $messagetext = $message['comment_text'];

            if ($currentdate !== $date) {

                $currentdate = $date;

                echo "<p style='color: gray; text-align: center; font-size: 15px;'>$date</p>";

            }

            if ($message['from_user'] == $otheruser) {

                ?> 
                
                <div class="toyou" style="margin-bottom: 25px;">

                    <?php echo "<img style='margin-top:-5px;' class='AvatarMed' src='$AvatarPath'> <div style='display: inline-block; padding-left:5px;'><span style='color: black; font-weight: bold ; font-size: 20px;'>$otheruser </span><span style='color: gray; font-size: 18px;'>$time</span><br><br><span style='color: black; font-size: 15px;'>‎ ‎ $messagetext</span></div>" ?>

                </div>
                
                <?php

            } else if ($message['from_user'] == $_SESSION['user_username']){

                ?> 
                
                <div class="fromyou" style="margin-bottom: 25px;">

                <?php echo "<span style='color: gray; font-size: 18px; float:right;'>$time</span><br><br><span style='color: black; font-size: 15px; float:right;'>‎ ‎ $messagetext</span>" ?>

                </div>
                
                <?php

            }

        }

        ?> 
        
        <a name="end"></a>
        
        <?php

    };

}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo "<title>Chatting With $otheruser</title>"; ?>
        <link rel="icon" type="image/x-icon" href="imgs/Chatrooms-logo.png">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body >
        
        <?php include('includes/navBar.php'); 
        
        echo "<br><div style='text-align:center;'><h1 style='display:inline; position: relative; top: -40px; font-size: 35px; margin-right: 15px;'>Your Chats With $otheruser</h1> <img class='AvatarBig' src='$otheruserAvatarpath'> </div>";
        
        ?>
    <div style="position: relative;">
        <div class="chatwindow">

            <?php 

                printAllMessages($pdo, $otheruser)
            
            ?>

        </div>

        <form method="post">
        
            <div class="typemessage">
                
                <input style="display:inline;" type="text" id="messagetext" name="messagetext"> <button style="display:inline;" class="sendmessage" id="messgesubmit"><img src="imgs/sendmessage.png"></button>

            </div>

        </form>

    </div>
    </body>
    </html>