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

function delete_user(id){
    var answer = confirm('Are you sure?');
    if(answer){
        window.location = 'delete.php?id=' + id;
    }
}    

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
        $('#pcp').val(res.data.pcp);

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
        $('#provider option[value=' + res.data.insurance + ']').attr('selected', 'selected');

    });

});
