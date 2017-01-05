<?php
/**
 * Created by PhpStorm.
 * User: aequalis
 * Date: 21/12/16
 * Time: 2:54 PM
 */
include_once "../../classes/livesearch.php";
session_start();
if (isset($_SESSION['username']) && isset($_POST['id'])) {
    $id = trim($_POST['id']);
    $showById = new LiveSearch();
    $resultById = $showById->getEmployeeById($id);
    ?>
    <table id="office" class="table table-bordered table-striped">
        <?php
        if ($resultById) {
            ?>
            <tr>
                <td>Name</td>
                <td><?php echo $resultById['firstname'] . "&nbsp;" . $resultById['lastname']; ?></td>
            </tr>
            <tr>
                <td>Office</td>
                <td><?php echo $resultById['designation']; ?></td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><?php echo date('d-m-Y'); ?></td>
            </tr>
            <tr>
                <td>Salary</td>
                <td><?php echo $resultById['salary']; ?></td>
            </tr>

        <?php } else {
            ?>
            <tr>
                <td colspan="2"><?php echo "No records found"; ?></td>
            </tr>
            <?php
        } ?>
    </table>
<?php } ?>