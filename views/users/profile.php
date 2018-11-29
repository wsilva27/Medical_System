<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'user.profile';
?>
<!DOCTYPE html>
<html>
    <?php require('../../header.inc.php') ?>
    <body>
        <?php 
            require('../../nav.php');
            require('breadcrumb.inc.php');
        ?>
        <form id="profile" class="needs-validation" novalidate>
            <div class="offset-2 col-10">
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-outline-info btn-sm" type="button" onclick="user.save()"><i class="fas fa-save"></i> Save</button>
<!--                        <button class="btn btn-outline-danger btn-sm" type="button">Remove</button>-->
                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="window.location='./';"><i class="fas fa-list-ol"></i> List</button>
                    </div>
                </div>

                <input type="hidden" id="idx" value="<?php echo $_SESSION['idx']; ?>"/>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> PERSONAL INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="firstName">FIRST NAME</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a first name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="lastName">LAST NAME</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a last name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="department">DEPARTMENT</label>
                        <select id="department" name="department" class="form-control" required></select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a department.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info alert-sm"><i class="fas fa-edit"></i> SYSTEM INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="userName">USER NAME</label>
                        <input type="text" id="userName" name="userName" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a user name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="userGroup">USER GROUP</label>
                        <select id="userGroup" name="userGroup" class="form-control" required></select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a user group.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="password">PASSWORD</label>
                        <input type="password" id="pwd" name="pwd" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a current password.
                        </div>
                    </div>
<!--
                    <div class="col-3">
                        <label for="password">NEW PASSWORD</label>
                        <input type="password" id="passwordN" name="passwordN" class="form-control" required="true" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a new password.
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="passwordC">CONFIRM PASSWORD</label>
                        <input type="password" id="passwordC" name="passwordC" class="form-control" required="true" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a new password confirmed.
                        </div>
                    </div>
-->
                </div>
            </div>
        </form>
        <?php require('../../bottom.php'); ?>
    </body>
</html>
