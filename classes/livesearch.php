<?php

/**
 * Created by PhpStorm.
 * User: Rajiv
 * Date: 10/12/16
 * Time: 12:53 PM
 */
require_once "db_config.php";

class LiveSearch extends DB
{
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
            return false .$err_msg;
        }
    }

    public function getLiveSearchAll()
    {
        $allRows=array();
        $query = "SELECT * FROM employees";
        $result = mysql_query($query);
        if ($result) {
            while ($rows = mysql_fetch_array($result)){
                $allRows[]=$rows;
            }
            return $allRows;
        } else {
            $err_msg = "DB Connection issue" . mysql_error();
            return $err_msg;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}