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
        url: '../../api/get.patient.profile.php'
    }).done(function(res){
        $('#name').val(res.data.name);
        $('#dob').val(res.data.dob);
        $('#address').val(res.data.address);
        $('#city').val(res.data.city);
        $('#zip').val(res.data.zip);
        $('#phone').val(res.data.phone);
        $('#email').val(res.data.email);
        $('#insurance').val(res.data.insurance);

        res.bloodtypes.forEach(function(bloodtype){
            $('#bloodtype').append(new Option(bloodtype.bloodtype, bloodtype.id));
        });
        $('#bloodtype option[value=' + res.data.bloodtype + ']').attr('selected', 'selected');

        res.states.forEach(function(state){
            $('#state').append(new Option(state.code, state.id));
        });
        $('#state option[value=' + res.data.state + ']').attr('selected', 'selected');

        res.insurances.forEach(function(insurance){
            $('#provider').append(new Option(insurance.provider, insurance.id));
        });
        $('#provider option[value=' + res.data.provider + ']').attr('selected', 'selected');

    });

});

var patient = new function(){
    this.save = function(){
        if(validator.isNotNull($('#name')) && validator.isNotNull($('#dob')) && validator.isNotNull($('#address')) && 
           validator.isNotNull($('#city')) && validator.isNotNull($('#zip'))){
            /* set parameter to request to save into database */
            var param = {
                idx: $('#idx').val(),
                name: $('#name').val(),
                dob: $('#dob').val(),
                bloodtype: $('#bloodtype').val(),
                address: $('#address').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                zip: $('#zip').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                provider: $('#provider').val(),
                insurance: $('#insurance').val()
            };
            /* ajax call */
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.patient.profile.php',
                data: param
            }).done(function(res){
                if($('idx').val() == '0')
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+INSERT_SUCCESS).show().fadeOut(5000);
                else
                    $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+UPDATE_SUCCESS).show().fadeOut(5000);
                $('#idx').val(res.id);

                $('#idx').val(res.id);
            }).fail(function(res){
                $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR).show().fadeOut(5000);
            });
        }
    };    
};

