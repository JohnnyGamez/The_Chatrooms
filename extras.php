require_once 'includes/config_session.inc.php';

if (isset($_SESSION['logedIn']) && $_SESSION['logedIn'] === "YES") {

    

} else {

    header("Location: Signinup.php?page=login"); 

}