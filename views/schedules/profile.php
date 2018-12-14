<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'schedule.profile';
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
                <div class="alert alert-info" id="alertinfo" style="display: none;"></div>
                <div class="alert alert-info" id="errorinfo" style="display: none;"></div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-outline-info btn-sm" type="button" onclick="schedule.save()"><i class="fas fa-save"></i> Save</button>
<!--                        <button class="btn btn-outline-danger btn-sm" type="button">Remove</button>-->
                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="window.location='./';"><i class="fas fa-list-ol"></i> List</button>
                    </div>
                </div>

                <input type="hidden" id="idx" value="<?php echo $_SESSION['idx']; ?>"/>
                <input type="hidden" id="patientid" />
                <input type="hidden" id="doctorid" />
                <div class="form-row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> PATIENT INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="name">NAME <i class="fas fa-sync"></i></label>
                        <input type="text" id="name" name="name" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="dob">DOB <i class="fas fa-sync"></i></label>
                        <input type="date" id="dob" name="dob" class="form-control" required readonly/>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a data of birth.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="phone">PHONE <i class="fas fa-sync"></i></label>
                        <input type="text" id="phone" name="phone" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a phone.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> SCHEDULE INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="doctorname">DOCTOR NAME <i class="fas fa-sync"></i></label>
                        <input type="text" id="doctorname" name="doctorname" class="form-control" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a doctor name.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="scheduledate">APPOINTMENT DATE</label>
                        <input type="date" id="scheduledate" name="scheduledate" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a appointment date.
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="scheduletime">APPOINTMENT TIME</label>
                        <input type="time" id="scheduletime" name="scheduletime" class="form-control" required step="300" />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a appointment time.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-8">
                        <label for="location">LOCATION <i class="fas fa-sync"></i></label>
                        <select id="location" name="location" class="form-control"></select>
                    </div>
                    <div class="col-4">
                        <label for="room">ROOM <i class="fas fa-sync"></i></label>
                        <select id="room" name="room" class="form-control"></select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="note">NOTE</label>
                        <textarea id="note" name="note" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div id="msg" class="alert alert-primary" hidden></div>
                    </div>
                </div>
            </div>
        </form>
        <?php require('../../bottom.php'); ?>
    </body>
</html>
