<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'schedule';
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
                                <th>SCHEDULE ID</th>
                                <th>PATIENT NAME</th>
                                <th>PATIENT DOB</th>
                                <th>PHONE</th>
                                <th>SCHEDULE DATE</th>
                                <th>SCHEDULE TIME</th>
                                <th>DOCTOR NAME</th>
                                <th>LOCATION</th>
                                <th>ROOM NUMBER</th>
                            </tr>
                        </thead>
                        <tbody>
                         </tbody>
                    </table>
                </div>
            </div>
<!--
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-outline-secondary btn-sm" onclick="patient.new();"><i class="fas fa-id-card-alt"></i> New</button>
                </div>
            </div>
-->
        </div>
        <?php require('../../bottom.php'); ?>
    </body>
</html>
