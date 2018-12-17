(function() {
    'use strict';
    window.addEventListener('load', function() {
        /* Fetch all the forms we want to apply custom Bootstrap validation styles to */
        var forms = document.getElementsByClassName('needs-validation');
        /* Loop over them and prevent submission */
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

/* $(document).ready: jquery's function that gathers the things that need to be run immediately after page loading. */
$(document).ready( function () {
    department.get().then(function(res){
        /* Assign the returned values to each input box */
        $('#name').val(res.data.name);
        $('#desc').val(res.data.desc);
    });
});

var department = new function(){
    
    this.get = function(){
        /* request a data with json type from the php file in api folder using jquery ajax */
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: base_URL + 'api/get.department.profile.php'
                }).done(function(res){
                    return res.data;
                });
    };
    
    this.save = function(){
        if(validator.isNotNull($('#name'))){
            /* collect data and create dataset to save */
            var param = {
                id: $('#idx').val(),
                name: $('#name').val(),
                desc: $('#desc').val()
            };
            
            /* transfer to php file in api folder to save using jquery ajax */
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: base_URL + 'api/set.department.profile.php',
                data: param
            }).done(function(res){
                /* popup result message in front-end */ 
                if($('idx').val() == '0')
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+INSERT_SUCCESS).show().fadeOut(5000);
                else
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+UPDATE_SUCCESS).show().fadeOut(5000);
                
                /* contain id into idx field */
                $('#idx').val(res.id);
            }).fail(function(res){
                $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR).show().fadeOut(5000);
            });
        }
    };
    
    this.remove = function(){
        
    };
};