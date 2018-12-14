(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

$(document).ready( function () {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        url: '../../api/get.doctor.profile.php'
    }).done(function(res){
        $('#doctorName').val(res.data.name);
        $('#suffix').val(res.data.suffix);
        $('#phoneNo').val(res.data.phone);
        setDocLocation(res.doctorlocations);
        setLocation(res.locations);
        setDocSpecialty(res.doctorspecialties);
        setSpecialty(res.specialties);
    });

    var setDocLocation = function(addr){
        var events = $('#events');
        var table = $('#tblDoctorLocation').DataTable({
            data: addr,
            select: true,
            columns: [
                { "data": "id" },
                { "data": "address" }
            ],
            scrollY: "230px",
            scrollCollapse: true,
            paging: false,
            responsive: true,
            bInfo: false,
            language: {
                emptyTable: "NO RECORD FOUND"
            }
        });
        table.column(0).visible( false );
        $('#tblDoctorLocation_filter').parent().parent().remove();
        $('#tblDoctorLocation tbody').on('dblclick', 'tr', function (){
            if(table.row(this).index() > -1){
                $('#tblLocation').DataTable().row.add({
                    id: table.cell(table.row(this).index(), 0).data(),
                    address: table.cell(table.row(this).index(), 1).data()
                }).draw(false);
                table.row(this).remove().draw( false );
            }
        });        
    };

    /* retrieve location data into datatable */
    var setLocation = function(addr){
        var events = $('#events');
        var row = { data: addr};
        var table = $('#tblLocation').DataTable({
            data: addr,
            select: true,
            columns: [
                { "data": "id" },
                { "data": "address" }
            ],
            scrollY: "230px",
            scrollCollapse: true,
            paging: false,
            responsive: true,
            bInfo: false,
            language: {
                emptyTable: "NO RECORD FOUND"
            }
        });
        table.column(0).visible( false );
        $('#tblLocation_filter').parent().parent().remove();
        $('#tblLocation tbody').on('dblclick', 'tr', function (){
            /* when user double click location info., data will be moved to doctor location table */
            if(table.row(this).index() > -1){
                $('#tblDoctorLocation').DataTable().row.add({
                    id: table.cell(table.row(this).index(), 0).data(),
                    address: table.cell(table.row(this).index(), 1).data()
                }).draw(false);
                table.row(this).remove().draw( false );
            }
        });
    };
    
    var setDocSpecialty = function(spec){
        var events = $('#events');
        var table = $('#tblDoctorSpecialty').DataTable({
            data: spec,
            select: true,
            columns: [
                { "data": "id" },
                { "data": "name" }
            ],
            scrollY: "230px",
            scrollCollapse: true,
            paging: false,
            responsive: true,
            bInfo: false,
            language: {
                emptyTable: "NO RECORD FOUND"
            }
        });
        table.column(0).visible( false );
        $('#tblDoctorSpecialty_filter').parent().parent().remove();        
        $('#tblDoctorSpecialty tbody').on('dblclick', 'tr', function (){
            if(table.row(this).index() > -1){
                $('#tblSpecialty').DataTable().row.add({
                    id: table.cell(table.row(this).index(), 0).data(),
                    name: table.cell(table.row(this).index(), 1).data()
                }).draw(false);
                table.row(this).remove().draw( false );
            }
        });
    };
    
    var setSpecialty = function(spec){
        var events = $('#events');
        var table = $('#tblSpecialty').DataTable({
            data: spec,
            select: true,
            columns: [
                { "data": "id" },
                { "data": "name" }
            ],
            scrollY: "230px",
            scrollCollapse: true,
            paging: false,
            responsive: true,
            bInfo: false,
            language: {
                emptyTable: "NO RECORD FOUND"
            }
        });
        table.column(0).visible( false );
        $('#tblSpecialty_filter').parent().parent().remove();
        $('#tblSpecialty tbody').on('dblclick', 'tr', function (){
            if(table.row(this).index() > -1){
                $('#tblDoctorSpecialty').DataTable().row.add({
                    id: table.cell(table.row(this).index(), 0).data(),
                    name: table.cell(table.row(this).index(), 1).data()
                }).draw(false);
                table.row(this).remove().draw( false );
            }
        });
    };
    
});
   
$(document).on('shown.bs.modal', function (e) {
      $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
});  

var doctor = new function(){
    this.save = function(){
        if(validator.isNotNull($('#doctorName')) && validator.isNotNull($('#suffix')) && validator.isNotNull($('#phoneNo')) ){
            /* datatable as variable */
            var tbldoc = $('#tblDoctorLocation').DataTable();
            var tblspec = $('#tblDoctorSpecialty').DataTable();

            /* temporary array variable to store ids each datatables */
            var locs = [];
            var specs = [];

            /* get ids and set array variable */
            tbldoc.rows().every(function(){
                locs.push(this.data().id);
            });
            tblspec.rows().every(function(){
                specs.push(this.data().id);
            });

            /* set parameter to request to save into database */
            var param = {
                id: $('#idx').val(),
                doctorname: $('#doctorName').val(),
                suffix: $('#suffix').val(),
                phoneNo: $('#phoneNo').val(),
                locations: locs.toString(),
                specialties: specs.toString()
            };
            console.log(param);
            /* ajax call */
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.doctor.profile.php',
                data: param
            }).done(function(res){
                console.log(res);
                /* show message of result */
                if($('idx').val() == '0')
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+INSERT_SUCCESS).show().fadeOut(5000);
                else
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+UPDATE_SUCCESS).show().fadeOut(5000);

                $('#idx').val(res.id);
            }).fail(function(res){
                $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR).show().fadeOut(5000);
            });
        }
    };    
};

