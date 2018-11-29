<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'specialty';
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
                                <th>SPECIALTIES ID</th>
                                <th>SPECIALTIES NAME</th>
                            </tr>
                        </thead>
                        <tbody>
                         </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-outline-secondary btn-sm" onclick="specialty.new();"><i class="fas fa-briefcase-medical"></i> New</button>
                </div>
            </div>
        </div>
        <?php require('../../bottom.php'); ?>
    </body>
</html>