<?php

session_start();
session_unset();
session_destroy();
header('Location: ../signinup.php?page=login');