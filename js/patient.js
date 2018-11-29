$(document).ready( function () {
    var events = $('#events');
    var table = $('#table').DataTable({
        ajax: '../../api/get.patient.php',
        select: true,
        columns: [
            { data: 'patientid' },
            { data: 'name' },
            { data: 'dob' },
            { data: 'address' },
            { data: 'phone' },
            { data: 'insurance' }
        ],
        scrollY: '500px',
        scrollCollapse: true,
        paging: false,
        language: {
            emptyTable: 'NO RECORD FOUND'
        }
    });

    $('#table tbody').on('click', 'tr', function (){
        var idx = table.row(this).index();
        var no = table.cell(idx, 0).data();
        $.post('../../api/set.session.php', { idx: no })
            .done(function(data){
                window.location='./profile.php';
            });
    });
});

var patient = new function(){
    this.new = function(){
        $.post('../../api/set.session.php', { idx: '0' })
            .done(function(data){
                window.location='./profile.php';
            });
    };
};