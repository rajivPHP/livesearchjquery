<?php

/**
 * Created by Rajiv.
 * User: Rajiv
 * Date: 10/12/16
 * Time: 12:53 PM
 */
require_once "db_config.php";

class LiveSearch
{
    public $host = DB_SERVER;
    public $username = DB_USERNAME;
    public $password = DB_PASSWORD;
    public $dbname = DB_DATABASE;
    public $db_connect;
    public $db_select;
    public $err_msg;

    public function __construct()
    {
        $this->db_connect = mysql_connect($this->host, $this->username, $this->password);
        if ($this->db_connect) {
            $this->db_select = mysql_select_db($this->dbname);
            return true;
        } else {
            $err_msg = "DB Connection Failed" . mysql_error();
            return false . $err_msg;
        }
    }

    public function getLiveSearchAll()
    {
        $allRows = array();
        $query = "SELECT * FROM employees";
        $result = mysql_query($query);
        if ($result) {
            while ($rows = mysql_fetch_array($result)) {
                $allRows[] = $rows;
            }
            return $allRows;
        } else {
            $err_msg = "DB Connection issue" . mysql_error();
            return $err_msg;
        }
    }

    public function getLiveSearchAllWebService()
    {
        $allRows = array();
        $query = "SELECT * FROM employees";
        $result = mysql_query($query);
        if ($result) {
            while ($rows = mysql_fetch_array($result)) {
                $allRows[] = $rows;
            }
            return json_encode($allRows);
        } else {
            $err_msg = "DB Connection issue" . mysql_error();
            return $err_msg;
        }
    }

    public function showLiveSearch()
    {
        $resultLiveAll = array();
        $sqlLiveSearch = "SELECT * FROM livesearch";
        $resultLiveSearch = mysql_query($sqlLiveSearch);
        if ($resultLiveSearch) {
            while ($resultLive = mysql_fetch_array($resultLiveSearch)) {
                $resultLiveAll[] = $resultLive;
            }
            return $resultLiveAll;
        } else {
            $err_msg = "Failed execution of query" . mysql_error();
            return $err_msg;
        }
    }

    public function loginUser($username, $password)
    {
        $resultUsers = array();
        $sqlUsersSearch = "SELECT * FROM users WHERE username='.$username' AND password='.$password'";
        $resultUsersSearch = mysql_query($sqlUsersSearch);
        if ($resultUsersSearch) {
            while ($resultUser = mysql_fetch_array($resultUsersSearch)) {
                $resultUsers[] = $resultUser;
            }
            return $resultUsers;
        } else {
            $err_msg = "Failed execution of query" . mysql_error();
            return $err_msg;
        }
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysql_close($this->db_connect);
    }
}