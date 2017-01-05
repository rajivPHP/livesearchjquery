<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 17/12/16
 * Time: 4:00 PM
 */
include "../config/config.php";
if (isset($_POST)) {
    include "../classes/livesearch.php";
    $getUser = new LiveSearch();
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $welcomeUser = $getUser->loginUser($username, $password);
    if ($welcomeUser) {
        session_start();
        $loggedInUser = $welcomeUser['0']['username'];
        $_SESSION['username'] = $loggedInUser;
        $_SESSION['loggedIn'] = 1;
        if ($loggedInUser == "admin") {
            header("location:homepage.php");
        } else {
            include("templates/header.php");
            include("templates/user/user_menu.php");
            include("templates/footer.php");
        }
    } else {
        header("location:" . BASE_URL . "");
    }
} else {
    header("location:" . BASE_URL . "");
}
?>
