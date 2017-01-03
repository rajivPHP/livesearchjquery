<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 3/1/17
 * Time: 11:44 AM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['id'])) {
    $id = trim($_POST['id']);
    $deleteEmployee = new LiveSearch();
    $resultDeleteEmployee = $deleteEmployee->deleteEmployee($id);
    if ($resultDeleteEmployee) {
        $msg = "Employee deletion was successful";
        header("location:../homepage?msg=$msg");
        return true;
    } else {
        $msg = "Employee deletion was not successful";
        header("location:../homepage?msg=$msg");
        return false;
    }
}
