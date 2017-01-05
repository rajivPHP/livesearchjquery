<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 4/1/17
 * Time: 6:57 PM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['employeeIds'])) {
    $empIds = $_POST['employeeIds'];
    $deleteMultiple = new LiveSearch();
    $resultDeleteMultipleEmployees = $deleteMultiple->deleteEmployeeMultiple($empIds);
    if ($resultDeleteMultipleEmployees) {
        $msg="Selected Employees Deleted Successfully";
        return $msg;
    } else {
        $msg="Selected Employees not Deleted Successfully";
        return $msg;
    }
}