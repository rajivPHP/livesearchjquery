<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 21/12/16
 * Time: 11:59 AM
 */
session_start();
include "../config/config.php";
session_destroy();
unset($_SESSION['username']);
header("location:" . BASE_URL . "");
?>