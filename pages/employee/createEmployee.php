 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="employeeadd" id="employeeadd">
        <div class="form-group">
            <label class="control-sidebar-subheading">
                First Name
                <input type="textbox" name="firstname" class="pull-right" id="firstname">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                last Name
                <input type="textbox" name="lastname" class="pull-right" id="lastname">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                Designation
                <input type="textbox" name="designation" class="pull-right" id="designation">
            </label>
        </div>
        <div class="form-group">
            <label class="control-sidebar-subheading">
                Salary
                <input type="textbox" name="salary" class="pull-right" id="salary">
            </label>
        </div>
        <div class="form-group">
            <input type="button" class="pull-right" value="CREATE" name="submit" onclick="validateEmployee();"
                   id="addemployee">
            <input type="reset" class="pull-right" value="Reset">
        </div>
    </form>
<script type="text/javascript">
    function validateEmployee() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var designation = $('#designation').val();
        var salary = $('#salary').val();
        if (firstname == '') {
            $.notify("Enter the Firstname");
            return false;
        }
        else if (lastname == '') {
            $.notify("Enter the Lastname");
            return false;
        }
        else if (designation == '') {
            $.notify("Enter the Designation");
            return false;
        }
        else if (salary == '') {
            $.notify("Enter the Salary");
            return false;
        }
        else {
            return true;
            //$('form').submit();

            $.ajax({
                type: "POST",
                url: "addEmployee.php",
                data: {firstname: firstname, lastname: lastname, designation: designation, salary: salary},
                beforeSend: function () {
                    console.log("sending");
                },
                success: function (data) {
                    //window.location.reload();
                }
            });
        }
    }
</script>