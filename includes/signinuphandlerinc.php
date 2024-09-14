<?php

require_once 'config_session.inc.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Signinup.php?page=login");

} else {

    header("Location: ../Signinup.php?login=success");

}