<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 3/1/17
 * Time: 3:01 PM
 */
session_start();
include_once "../../classes/livesearch.php";
if (isset($_POST['firstname'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $salary = trim($_POST['salary']);
    $designation = trim($_POST['designation']);
    $addEmployee = new LiveSearch();
    $resultAddEmployee = $addEmployee->createEmployee($firstname, $lastname, $salary, $designation);
    if ($resultAddEmployee) {
        $msg = "Employee Creation was successful";
        ?>
        <script type="text/javascript">
            $.notify("<?php echo $msg;?>");
        </script>
        <?php
        return true;
    } else {
        $msg = "Employee Creation was not successful";
        ?>
        <script type="text/javascript">
            $.notify("<?php echo $msg;?>");
        </script>
        <?php
        return false;
    }

}
?>