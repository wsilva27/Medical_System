$(document).ready( function () {

    /* Activating events for dynamically generated objects through jQuery */
    var events = $('#events');
    
    /* Getting data to the datatables */
    room.Get().then(function(res){
        var table = $('#table').DataTable({
            data: res.data,    
            select: true,
            columns: [
                { data: 'id' },
                { data: 'location' },
                { data: 'address' },
                { data: 'roomno' }
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
        $('#table_filter').append('<b><button class="btn btn-sm btn-outline-secondary add" onclick="room.new();" style="margin-left: 20px;margin-top:-4px;"><i class="fas fa-hospital-alt"></i> New</button></b>');

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

var room = new function(){
    
    /* Getting data from php in api folder using jQuery.ajax */
    /* "$." is equal to "jquery." */
    this.Get = function () {
        return $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: base_URL + 'api/get.room.php',
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
        $.post(base_URL + 'api/set.session.php', { idx: '0' })
        .done(function(data){
            window.location='./profile.php';
        });
    };
    
};
