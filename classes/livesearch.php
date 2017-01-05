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
        $this->db_connect = mysqli_connect($this->host, $this->username, $this->password,$this->dbname);
        if ($this->db_connect) {
            return true;
        } else {
            $err_msg = "DB Connection Failed" . mysqli_connect_error();
            return false . $err_msg;
        }
    }

    public function getLiveSearchAll()
    {
        $allRows = array();
        $query = "SELECT * FROM employees";
        $result = mysqli_query($this->db_connect,$query);
        if ($result) {
            while ($rows = mysqli_fetch_array($result)) {
                $allRows[] = $rows;
            }
            return $allRows;
        } else {
            $err_msg = "DB Connection issue" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function getLiveSearchAllWebService()
    {
        $allRows = array();
        $query = "SELECT * FROM employees";
        $result = mysqli_query($this->db_connect,$query);
        if ($result) {
            while ($rows = mysqli_fetch_array($result)) {
                $allRows[] = $rows;
            }
            return json_encode($allRows);
        } else {
            $err_msg = "DB Connection issue" . mysqli_connect_error();
            return $err_msg;
        }
    }
    public function getEmployeesAll()
    {
        $allRows = array();
        $query = "SELECT * FROM employees";
        $result = mysqli_query($this->db_connect,$query);
        if ($result) {
            while ($rows = mysqli_fetch_array($result)) {
                $allRows[] = $rows;
            }
            return $allRows;
        } else {
            $err_msg = "DB Connection issue" . mysqli_connect_error();
            return $err_msg;
        }
    }


    public function showLiveSearch()
    {
        $resultLiveAll = array();
        $sqlLiveSearch = "SELECT * FROM livesearch";
        $resultLiveSearch = mysqli_query($this->db_connect,$sqlLiveSearch);
        if ($resultLiveSearch) {
            while ($resultLive = mysqli_fetch_array($resultLiveSearch)) {
                $resultLiveAll[] = $resultLive;
            }
            return $resultLiveAll;
        } else {
            $err_msg = "Failed execution of query" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function loginUser($username, $password)
    {
        $resultUsers = array();
        $sqlUsersSearch = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
        $resultUsersSearch = mysqli_query($this->db_connect,$sqlUsersSearch);
        if ($resultUsersSearch) {
            while ($resultUser = mysqli_fetch_array($resultUsersSearch)) {
                $resultUsers[] = $resultUser;
            }
            return $resultUsers;
        } else {
            $err_msg = "Failed execution of query" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function getEmployeeById($id)
    {
        $resultEmployee = array();
        $sqlEmployeeSearch = "SELECT * FROM employees WHERE id= '" . $id . "'";
        $resultEmployeeSearch = mysqli_query($this->db_connect,$sqlEmployeeSearch);
        if (mysqli_num_rows($this->db_connect,$resultEmployeeSearch) !== NULL) {
            $resultEmployee = mysqli_fetch_assoc($resultEmployeeSearch) or die(mysqli_connect_error());
            return $resultEmployee;
        } else {
            $err_msg = "Failed execution of query" . mysqli_connect_error();
            return $err_msg;
        }

    }

    public function updateEmployees($empId, $firstName, $lastName, $salary, $designation)
    {
        $sqlEmployeeUpdate = "UPDATE employees SET firstname='" . $firstName . "',lastname='" . $lastName . "',
  designation='" . $designation . "',salary='" . $salary . "'
        WHERE id=$empId";
        $resultEmployeeUpdate = mysqli_query($this->db_connect,$sqlEmployeeUpdate);
        if ($resultEmployeeUpdate) {
            return $resultEmployeeUpdate;
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function deleteEmployee($id)
    {
        $sqlEmployeeDelete = "DELETE FROM employees WHERE id=$id";
        $resultEmployeeDelete = mysqli_query($this->db_connect,$sqlEmployeeDelete);
        if ($resultEmployeeDelete) {
            return $resultEmployeeDelete;
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function createEmployee($firstname, $lastname, $salary, $designation)
    {
        $sqlEmployeeAdd = "INSERT INTO employees(firstname,lastname,salary,designation)
        VALUES('$firstname','$lastname','$salary','$designation')";
        $resultEmployeeAdd = mysqli_query($this->db_connect,$sqlEmployeeAdd);
        if ($resultEmployeeAdd) {
            return $resultEmployeeAdd;
            //return mysqli_affected_rows($resultEmployeeAdd);
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function deleteEmployeeMultiple($empIds)
    {
        $eIds = implode(",", $empIds);
        if ($eIds) {
            $sqlDeleteEmployeeMultiple = "DELETE FROM employees where id IN($eIds);";
            $resultDeleteEmployeeMultiple = mysqli_query($this->db_connect,$sqlDeleteEmployeeMultiple);
            if ($resultDeleteEmployeeMultiple) {
                return 1;
            }
        } else {
            $err_msg = "Failed execution of query&nbsp;" . mysqli_connect_error();
            return $err_msg;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysqli_close($this->db_connect);
    }
}