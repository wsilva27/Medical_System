<?php
    session_start();
    require('../../conf/url.php');
    $_SESSION['page_name'] = 'doctor.profile';
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
                        <button class="btn btn-outline-info btn-sm" type="button" onclick="doctor.save();"><i class="fas fa-save"></i> Save</button>
<!--                        <button class="btn btn-outline-danger btn-sm" type="button">Remove</button>-->
                        <button class="btn btn-outline-secondary btn-sm" type="button" onclick="window.location='./';"><i class="fas fa-list-ol"></i> List</button>
                    </div>
                </div>

                <input type="hidden" id="idx" value="<?php echo $_SESSION['idx']; ?>"/>
                <div class="form-row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> DOCTOR INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="doctorName">DOCTOR NAME</label>
                        <input type="text" id="doctorName" name="doctorName" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a doctor name.
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="suffix">SUFFIX</label>
                        <input type="text" id="suffix" name="suffix" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a suffix.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="phoneNo">PHONE NUMBER</label>
                        <input type="text" id="phoneNo" name="phoneNo" class="form-control" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please choose a phone number.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fas fa-edit"></i> LOCATION INFO</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <label for="tblDoctorLocation">LOCATION-ADDRESS</label>
                                <span class="badge badge-danger badge-notice">DOUBLE CLICK EACH ROW TO REMOVE</span>
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('#modalLocation').modal('show');"><i class="fas fa-search"></i> Location</button>
                            </div>
                        </div>
                        <table id="tblDoctorLocation" class="display table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ADDRESSES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-9">
                                <label for="tblDoctorSpecialty">SECIALTY</label>
                                <span class="badge badge-danger badge-notice">DOUBLE CLICK EACH ROW TO REMOVE</span>
                            </div>
                            <div class="col-3 text-right">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('#modalSpecialty').modal('show');"><i class="fas fa-search"></i> Specialty</button>
                            </div>
                        </div>
                        <table id="tblDoctorSpecialty" class="display table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>SECIALTIES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        
        <div id="modalLocation" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">LOCATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="tblLocation" class="display table table-bordered">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th>ID</th>
                                            <th>ADDRESSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="badge badge-info badge-notice">DOUBLE CLICK EACH ROW TO SELECT</span>                        
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>        
        
        <div id="modalSpecialty" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SPECIALTY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="tblSpecialty" class="display table table-bordered">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th>ID</th>
                                            <th>SECIALTIES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="badge badge-info badge-notice">DOUBLE CLICK EACH ROW TO SELECT</span>                        
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>        
        
        <?php require('../../bottom.php'); ?>
    </body>
</html>
