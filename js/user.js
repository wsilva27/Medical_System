$(document).ready( function () {
    var events = $('#events');
    var table = $('#table').DataTable({
        ajax: '../../api/get.user.php',
        select: true,
        "columns": [
            { "data": "USER_ID" },
            { "data": "FIRST_NAME" },
            { "data": "LAST_NAME" },
            { "data": "USER_NAME" },
            { "data": "DEPT_NAME" },
            { "data": "GROUP_NAME" }
        ],
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });

    $('#table tbody').on('click', 'tr', function (){
        var idx = table.row(this).index();
        var no = table.cell(idx, 0).data();
        $.post('../../api/set.session.php', { "idx": no })
            .done(function(data){
                window.location='./profile.php';
            });
    });
});

var user = new function(){
    this.new = function(){
        console.log('aaaa');
        $.post('../../api/set.session.php', { "idx": '0' })
            .done(function(data){
                window.location='./profile.php';
            });
    };
};
