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
        url: base_URL + 'api/get.room.profile.php'
    }).done(function(res){
        $('#roomno').val(res.data.roomno);
        res.locations.forEach(function(location){
            $('#location').append(new Option((location.address + ' ' + location.city + ', ' + location.state + ' ' + location.zip), location.id));
        });
        $('#location option[value=' + res.data.location + ']').attr('selected', 'selected');
    });
});

var room = new function(){
    this.save = function(){
        if(validator.isNumber($('#location')) && validator.isNotNull($('#roomno'))){
            var param = {
                id: $('#idx').val(),
                location: $('#location').val(),
                roomno: $('#roomno').val()
            };
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: base_URL + 'api/set.room.profile.php',
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
}

