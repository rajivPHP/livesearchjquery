<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 5/1/17
 * Time: 11:04 AM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username'])) {
    $exportAll = new LiveSearch();
    $resultExport = $exportAll->getEmployeesAll();
    $htmlData = "<html>";
    $htmlData .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    $htmlData .= "<body>";
    $htmlData .= "<table>";
    $htmlData .= "<tr>";
    $htmlData .= "<td>Name</td>";
    $htmlData .= "<td>office</td>";
    $htmlData .= "<td>Designation</td>";
    $htmlData .= "<td>Salary</td>";
    $htmlData .= "</tr>";
    foreach ($resultExport as $item) {
        $htmlData .= "<tr>";
        $htmlData .= "<td>";
        $htmlData .= $item['firstname'];
        $htmlData .= "</td>";
        $htmlData .= "<td>";
        $htmlData .= $item['lastname'];
        $htmlData .= "</td>";
        $htmlData .= "<td>";
        $htmlData .= $item['office'];
        $htmlData .= "</td>";
        $htmlData .= "<td>";
        $htmlData .= $item['designation'];
        $htmlData .= "</td>";
        $htmlData .= "</tr>";
    }
    $htmlData .= "</table>";
    $htmlData .= "</body>";
    $htmlData .= "</html>";
    echo $htmlData;
}