<?php
session_start();
include "../config/config.php";
require_once "../classes/livesearch.php";
include("templates/header.php");
include("templates/admin/admin_menu.php");
?>
<?php if (isset($_SESSION['username'])) { ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage Employee
                <small>List Employees</small>
            </h1>
            <!-- <ol class="breadcrumb">
                 <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                 <li><a href="#">Examples</a></li>
                 <li class="active">Blank page</li>
             </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Employees</h3>
                    <button type="button" id="createemployee" class="btn btn-success pull-right" style="margin:0 60px"
                            onclick="createEmployee();"><i class="fa fa fa-user"></i> CREATE EMPLOYEE
                    </button>
                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php if (isset($_GET['msg'])) {
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <?php echo $_GET['msg']; ?>
                        </div>
                        <?php
                    } else {
                        header("location:homepage.php");
                    }
                    ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped" id="employees" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                /**
                                 * Created by Rajiv.
                                 * User: Rajiv
                                 * Date: 10/12/16
                                 * Time: 12:53 PM
                                 */
                                $liveSearchDetails = new LiveSearch();
                                $resultAllDetails = $liveSearchDetails->getLiveSearchAll();
                                if ($resultAllDetails) {
                                    $i = 1;
                                    foreach ($resultAllDetails as $showDetails) {
                                        ?>
                                        <tr class="ui-state-default" id="dragclass">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $showDetails['firstname']; ?></td>
                                            <td><?php echo $showDetails['lastname']; ?></td>
                                            <td><?php echo $showDetails['designation']; ?></td>
                                            <td><?php echo date('d-m-Y'); ?></td>
                                            <td><?php echo $showDetails['salary']; ?>
                                            <td><a href="?id=<?php echo $showDetails['id']; ?>" id="editemployee"
                                                   name="editemployee"
                                                   onclick="updateSource(<?php echo $showDetails['id']; ?>);return false;"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="?id=<?php echo $showDetails['id']; ?>" id="editemployee"
                                                   name="deleteemployee"
                                                   onclick="return deleteEmployee(<?php echo $showDetails['id']; ?>);"><i
                                                        class="fa fa-remove"></i></a></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4"><strong><?php echo "No Records Found!!!"; ?></strong></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <?php include_once "library.php";
    ?>
    <script type="text/javascript">

        $(document).ready(function () {

            $('.close').click(function () {
                <?php header("location:homepage.php");?>
            });

            $('#employees').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
        
        function updateSource(id, name) {
            var name = name;
            $.ajax({
                type: "POST",
                url: 'employee/showEmployee.php',
                data: {id: id},
                beforeSend: function () {
                    console.log("sending");
                },
                success: function (data) {
                    var dialog = $('<div id=\'show_dialog\'></div>').dialog({
                        title: name,
                        open: function (event, ui) {
                            $(".ui-widget-overlay").css({
                                opacity: 1.0,
                                filter: "Alpha(Opacity=100)",
                                backgroundColor: "#9e9e9e"
                            });
                        },
                        modal: true,
                        beforeClose: function (event, ui) {
                            $("body").css({overflow: 'inherit'})
                        }
                    });
                    dialog.html(data);
                }
            });
        }
        function deleteEmployee(id) {
            var confirm = window.confirm("Are you sure to delete Employee");
            if (confirm == true) {
                var id = id;
                $.ajax({
                    type: "POST",
                    url: 'employee/deleteEmployee.php',
                    data: {id: id},
                    beforeSend: function () {
                        console.log("sending");
                    },
                    success: function (data) {
                        alert(data);
                    }
                });
            }
            else {
                return false;
            }
        }
        function createEmployee() {
            $.ajax({
                type: "POST",
                url: 'employee/createEmployee.php',
                beforeSend: function () {
                    console.log("sending");
                },
                success: function (data) {
                    var dialog = $('<div id=\'show_dialog\'></div>').dialog({
                        title: name,
                        open: function (event, ui) {
                            $(".ui-widget-overlay").css({
                                opacity: 1.0,
                                filter: "Alpha(Opacity=100)",
                                backgroundColor: "#9e9e9e"
                            });
                        },
                        modal: true,
                        beforeClose: function (event, ui) {
                            $("body").css({overflow: 'inherit'})
                        }
                    });
                    dialog.html(data);
                }
            });
        }
        /* $('#editemployee').on("click", function (event) {
         event.preventDefault();
         });*/
    </script>
    <?php
} else {
    header("location:" . BASE_URL . "");
}
?>
<?php include("templates/footer.php"); ?>