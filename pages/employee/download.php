<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 5/1/17
 * Time: 3:17 PM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username'])) {
    if (isset($_GET['filename'])) {
        $file=$_GET['filename'];
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$file."");
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: binary/octet-stream");
        readfile($file);
    }
}