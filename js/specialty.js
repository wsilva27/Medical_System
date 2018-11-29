$(document).ready( function () {
    var events = $('#events');
    var table = $('#table').DataTable({
        ajax: '../../api/get.specialty.php',
        select: true,
        columns: [
            { data: 'id' },
            { data: 'name' }
        ],
        scrollY: '500px',
        scrollCollapse: true,
        paging: false,
        responsive: true,
        language: {
            emptyTable: 'NO RECORD FOUND'
        }
    });

    table.column(0).visible( false );
    
    $('#table tbody').on('click', 'tr', function (){
        var idx = table.row(this).index();
        var no = table.cell(idx, 0).data();
        $.post('../../api/set.session.php', { idx: no })
            .done(function(data){
                window.location='./profile.php';
            });
    });
});

var specialty = new function(){
    this.new = function(){
        $.post('../../api/set.session.php', { idx: '0' })
            .done(function(data){
                window.location='./profile.php';
            });
    };
};
