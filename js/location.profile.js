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
        url: '../../api/get.location.profile.php'
    }).done(function(res){
        console.log(res);
        $('#name').val(res.data.name);
        $('#address').val(res.data.address);
        $('#city').val(res.data.city);
        $('#zip').val(res.data.zip);
        
        res.states.forEach(function(state){
            $('#state').append(new Option(state.code, state.id));
        });
        $('#state option[value=' + res.data.state + ']').attr('selected', 'selected');

    });

});

var loc = new function(){
    this.save = function(){
        if(validator.isNotNull($('#name')) && validator.isNotNull($('#address')) && 
           validator.isNotNull($('#city')) && validator.isNumber($('#state')) && validator.isZip($('#zip'))){
            var param = {
                id: $('#idx').val(),
                name: $('#name').val(),
                address: $('#address').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                zip: $('#zip').val()
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.location.profile.php',
                data: param
            }).done(function(res){
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
    
    this.remove = function(){
        
    };
};

