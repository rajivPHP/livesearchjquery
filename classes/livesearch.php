<?php

/**
 * Created by Rajiv.
 * User: Rajiv
 * Date: 10/12/16
 * Time: 12:53 PM
 */
require_once "config/db_config.php";

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
        $sqlUsersSearch = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
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

    public function getEmployeeById($id)
    {
        $resultEmployee = array();
        $sqlEmployeeSearch = "SELECT * FROM employees WHERE id= '" . $id . "'";
        $resultEmployeeSearch = mysql_query($sqlEmployeeSearch);
        if (mysql_num_rows($resultEmployeeSearch) !== NULL) {
            $resultEmployee = mysql_fetch_assoc($resultEmployeeSearch) or die(mysql_error());
            return $resultEmployee;
        } else {
            $err_msg = "Failed execution of query" . mysql_error();
            return $err_msg;
        }

    }

    public function updateEmployees($empId, $firstName, $lastName, $salary, $designation)
    {
        $sqlEmployeeUpdate = "UPDATE employees SET firstname='" . $firstName . "',lastname='" . $lastName . "',
  designation='" . $designation . "',salary='" . $salary . "'
        WHERE id=$empId";
        $resultEmployeeUpdate = mysql_query($sqlEmployeeUpdate);
        if ($resultEmployeeUpdate) {
            return $resultEmployeeUpdate;
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysql_error();
            return $err_msg;
        }
    }

    public function deleteEmployee($id)
    {
        $sqlEmployeeDelete = "DELETE FROM employees WHERE id=$id";
        $resultEmployeeDelete = mysql_query($sqlEmployeeDelete);
        if ($resultEmployeeDelete) {
            return $resultEmployeeDelete;
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysql_error();
            return $err_msg;
        }
    }

    public function createEmployee($firstname, $lastname, $salary, $designation)
    {
        $sqlEmployeeAdd = "INSERT INTO employees(firstname,lastname,salary,designation)
        VALUES('$firstname','$lastname','$salary','$designation')";
        $resultEmployeeAdd = mysql_query($sqlEmployeeAdd);
        if ($resultEmployeeAdd) {
            return $sqlEmployeeAdd;
            //return mysql_affected_rows($resultEmployeeAdd);
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysql_error();
            return $err_msg;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysql_close($this->db_connect);
    }
}