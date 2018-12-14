<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'department.profile';
?>
<!DOCTYPE html>
<html>
    <?php require('../../header.inc.php'); ?>
    <body>
        <?php 
            require('../../nav.php');
            require('breadcrumb.inc.php');
        ?>
        <form id="profile" class="needs-validation" novalidate>
            <div class="offset-2 col-10">
                <div class="alert alert-info" id="alertinfo" style="display: none;"></div>
                <div class="alert alert-info" id="errorinfo" style="display: none;"></div>
                <div class="form-row">
                    <div class="col-12 text-right">
                        <button class="btn btn-outline-info btn-sm" type="button" onclick="department.save()"><i class="fas fa-save"></i> Save</button>
<!--                        <button class="btn btn-outline-danger btn-sm" type="button">Remove</button>-->
                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="window.location='./';"><i class="fas fa-list-ol"></i> List</button>
                    </div>
                </div>

                <input type="hidden" id="idx" value="<?php echo $_SESSION['idx']; ?>"/>
                <div class="form-row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> DEPARTMENT INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="name">NAME</label>
                        <input type="text" id="name" name="name" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a title of specialty.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="title">DESCRIPTION</label>
                        <textarea type="text" id="desc" name="desc" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </form>
        <?php require('../../bottom.php'); ?>
    </body>
</html>
