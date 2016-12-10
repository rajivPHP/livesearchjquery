<html lang="en">
<head>
    <title>Live Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table-bordered table pull-right" id="mytable" cellspacing="0" style="width: 100%;">
                <thead>
                <tr>
                    <td colspan="6">
                        <div class="form-group">
                            <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                   placeholder="Type to search table...">
                        </div>
                    </td>
                </tr>
                <tr role="row">
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * Created by PhpStorm.
                 * User: Rajiv
                 * Date: 10/12/16
                 * Time: 12:53 PM
                 */
                require_once "classes/livesearch.php";
                $liveSearchDetails = new LiveSearch();
                $resultAllDetails = $liveSearchDetails->getLiveSearchAll();
                if ($resultAllDetails) {
                    $i = 1;
                    foreach ($resultAllDetails as $showDetails) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $showDetails['firstname']; ?></td>
                            <td><?php echo $showDetails['lastname']; ?></td>
                            <td><?php echo $showDetails['designation']; ?></td>
                            <td><?php echo date('d-m-Y'); ?></td>
                            <td><?php echo $showDetails['salary']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4"><?php echo $i; ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search').keyup(function () {
            var _this = this;
            $('#mytable tbody tr').each(function () {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1) {
                    $(this).hide();
                    // $(this).text("Nothing Matching Found");
                }
                else {
                    $(this).show();
                }
            });
            console.log(_this);
        });
    });
</script>
</body>
</html>
