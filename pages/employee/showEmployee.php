<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 21/12/16
 * Time: 3:19 PM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['id'])) {
    $id = trim($_POST['id']);
    $showById = new LiveSearch();
    $resultById = $showById->getEmployeeById($id);
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label class="control-sidebar-subheading">
                First Name
                <input type="textbox" name="firstname" class="pull-right"
                       value="<?php echo $resultById['firstname']; ?>">
                <input type="hidden" name="empid" class="pull-right"
                       value="<?php echo $resultById['id']; ?>">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                last Name
                <input type="textbox" name="lastname" class="pull-right" value="<?php echo $resultById['lastname']; ?>">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                Designation
                <input type="textbox" name="designation" class="pull-right"
                       value="<?php echo $resultById['designation']; ?>">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                Salary
                <input type="textbox" name="salary" class="pull-right" value="<?php echo $resultById['salary']; ?>">
            </label>
        </div>
        <div class="form-group">
            <input type="submit" class="pull-right" value="Update" name="submit">
            <input type="reset" class="pull-right" value="Reset">
        </div>
    </form>

    <?php
} else if (isset($_SESSION['username']) && isset($_POST['submit'])) {
    $empId = trim($_POST['empid']);
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $designation = trim($_POST['designation']);
    $salary = trim($_POST['salary']);
    $modifyEmployee = new liveSearch();
    $result = $modifyEmployee->updateEmployees($empId, $firstName, $lastName, $salary, $designation);
    if ($result) {
        $msg = "Updated successfully";
        header("location:../homepage.php?msg=$msg");
        return true;
    } else {
        echo "failure";
        return false;
    }
} else {
    return false;
    header("location:../index.php");
}