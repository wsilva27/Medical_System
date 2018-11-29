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
        url: '../../api/get.department.profile.php'
    }).done(function(res){
        $('#name').val(res.data.name);
        $('#desc').val(res.data.desc);
    });

});

var department = new function(){
    this.save = function(){
        if(validator.isNotNull($('#name'))){
            var param = {
                id: $('#idx').val(),
                name: $('#name').val(),
                desc: $('#desc').val()
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.department.profile.php',
                data: param
            }).done(function(res){
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
    
    this.remove = function(){
        
    };
};