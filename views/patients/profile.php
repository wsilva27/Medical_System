<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'patient.profile';
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
                        <button class="btn btn-outline-info btn-sm" type="button" onclick="patient.save()"><i class="fas fa-save"></i> Save</button>
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
                        <label for="name">NAME</label>
                        <input type="text" id="name" name="name" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="dob">DOB</label>
                        <input type="date" id="dob" name="dob" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a data of birth.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="bloodtype">BLOOD TYPE</label>
                        <select id="bloodtype" name="bloodtype" class="form-control" required></select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a brood type.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="address">ADDRESS</label>
                        <input type="text" id="address" name="address" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a address.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="city">CITY</label>
                        <input type="text" id="city" name="city" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a data of birth.
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="state">STATE</label>
                        <select id="state" name="state" class="form-control" required></select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a state.
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="zip">ZIP</label>
                        <input type="text" id="zip" name="zip" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a zip.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="phone">PHONE</label>
                        <input type="text" id="phone" name="phone" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a phone.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="email">EMAIL</label>
                        <input type="text" id="email" name="email" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a email.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info alert-sm"><i class="fas fa-edit"></i> INSURANCE INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="pcp">PCP</label>
                        <input type="text" id="pcp" name="pcp" class="form-control" />
                    </div>
                    <div class="col-6">
                        <label for="provider">PROVIDER</label>
                        <select id="provider" name="provider" class="form-control"></select>
                    </div>
                </div>
            </div>
        </form>
        <?php require('../../bottom.php'); ?>
    </body>
</html>
