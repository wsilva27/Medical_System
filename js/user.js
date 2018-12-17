$(document).ready( function () {
    
    /* Activating events for dynamically generated objects through jQuery */
    var events = $('#events');
    
    /* Getting data to the datatables */
    user.Get().then(function(res){
        var table = $('#table').DataTable({
            data: res.data,    
            select: true,
            "columns": [
                { "data": "USER_ID" },
                { "data": "FIRST_NAME" },
                { "data": "LAST_NAME" },
                { "data": "USER_NAME" },
                { "data": "DEPT_NAME" },
                { "data": "GROUP_NAME" }
            ],
            columnDefs:[
                {    /* Make certain columns invisible */
                    visible: false,
                    targets: [0]
                }
            ],
            scrollY: '500px',   /* Setting the height of the datatables */
            scrollCollapse: true,   /* Enable scroll bar without paging */
            paging: false,  /* Enable scroll bar without paging */
            responsive: true,   /* Width to respond to changes on screen */
            language: { /* When data is not available */
                emptyTable: 'NO RECORD FOUND'
            },
            dom: '<"toolbar">frtip' /* Set the custom toolbar on top of the datatables */
        });

        /* Add the "New" button to the toolbar at the top of the datatables */
        $('#table_filter').append('<b><button class="btn btn-sm btn-outline-secondary add" onclick="user.new();" style="margin-left: 20px;margin-top:-4px;"><i class="fas fa-user-plus"></i> New</button></b>');        

        /* When the row of the data table is pressed, will be transit to detail page. */
        $('#table tbody').on('click', 'tr', function (){
            /* Get index of the pressed row */
            var idx = table.row(this).index();
            /* Gets the ID of the data from the row */
            var no = table.cell(idx, 0).data();
            /* Save the ID value in the session and move it to the detailed screen */
            $.post(base_URL + 'api/set.session.php', { idx: no })
                .done(function(data){
                    window.location='./profile.php';
                });
        });
    });
});

var user = new function(){
    
    /* Getting data from php in api folder using jQuery.ajax */
    /* "$." is equal to "jquery." */
    this.Get = function () {
        return $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: base_URL + 'api/get.user.php',
                    contentType: 'application/json',
                    success: function(data, textStatus, jQxhr){
                        return data;
                    },
                    error: function(jQxhr, textStatus, errorThrown){
                        console.log(errorThrown);
                    }
        });
    };  
    
    /* When creating new details, set the ID value to 0 in the session and hand it over to the detail screen */
    this.new = function(){
        console.log('aaaa');
        $.post(base_URL + 'api/set.session.php', { "idx": '0' })
            .done(function(data){
                window.location='./profile.php';
            });
    };
    
};
