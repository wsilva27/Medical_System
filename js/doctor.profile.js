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
        setLocation('tblDoctorLocation', 
                    'tblLocation', 
                    res.doctorlocations, 
                    [{ 'data': 'id' }, { 'data': 'address' }]);
        setLocation('tblLocation', 
                    'tblDoctorLocation', 
                    res.locations, 
                    [{ 'data': 'id' }, { 'data': 'address' }]);
        setSpecialty('tblDoctorSpecialty', 
                     'tblSpecialty', 
                     res.doctorspecialties, 
                     [{ 'data': 'id' }, { 'data': 'name' }]);
        setSpecialty('tblSpecialty', 
                     'tblDoctorSpecialty', 
                     res.specialties, 
                     [{ 'data': 'id' }, { 'data': 'name' }]);
    });
    
    var setLocation = function(obj1, obj2, data, cols, param){
        var table = $('#' + obj1).DataTable({
            data: data,
            select: true,
            columns: cols,
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
        $('#' + obj1 + '_filter').parent().parent().remove();
        $('#' + obj1 + ' tbody').on('dblclick', 'tr', function (){
            if(table.row(this).index() > -1){
                $('#' + obj2).DataTable().row.add({
                    id: table.cell(table.row(this).index(), 0).data(),
                    address: table.cell(table.row(this).index(), 1).data()
                }).draw(false);
                table.row(this).remove().draw( false );
            }
        });              
    };
    
    var setSpecialty = function(obj1, obj2, data, cols, param){
        var table = $('#' + obj1).DataTable({
            data: data,
            select: true,
            columns: cols,
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
        $('#' + obj1 + '_filter').parent().parent().remove();
        $('#' + obj1 + ' tbody').on('dblclick', 'tr', function (){
            if(table.row(this).index() > -1){
                $('#' + obj2).DataTable().row.add({
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
        if(validator.isNotNull($('#doctorName')) && validator.isPhoneNumber($('#phoneNo'))){
            var param = {
                id: $('#idx').val(),
                doctorname: $('#doctorName').val(),
                suffix: $('#suffix').val(),
                phoneno: $('#phoneNo').val(),
                doctorlocation: this.getTableData($('#tblDoctorLocation')),
                doctorspecialty: this.getTableData($('#tblDoctorSpecialty'))
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.doctor.profile.php',
                data: param
            }).done(function(res){
                console.info(res);
                $('#msg').empty();
                if($('idx').val() == '0')
                    $('#msg').append(INSERT_SUCCESS);
                else
                    $('#msg').append(UPDATE_SUCCESS);
                $('#msg').removeAttr('hidden');
                setTimeout(function(){ $('#msg').attr('hidden', 'hidden'); }, 3000);
                $('#idx').val(res.id);
            }).fail(function(res){
                console.log('error');
            });
        }
    };    
    
    this.getTableData = function(obj){
        var table = obj.DataTable();   
        var res = [];
        table.rows().every(function(a){
            var data = this.data();
            res.push({ id: data.id});
        })
        console.log(res);
        return res;
    }
    
};

