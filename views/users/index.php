<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'user';
?>
<!DOCTYPE html>
<html>
    <?php require('../../header.inc.php'); ?>
    <body>
        <?php 
            require('../../nav.php');
            require('breadcrumb.inc.php');
        ?>
        <div class="offset-md-2 col-md-10">
            <div class="row">
                <div class="col-12">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>USER ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>USER NAME</th>
                                <th>DEPARTMENT</th>
                                <th>GROUP</th>
                            </tr>
                        </thead>
                        <tbody>
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require('../../bottom.php'); ?>
    </body>
</html>