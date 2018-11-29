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
        url: '../../api/get.user.profile.php'
    }).done(function(res){
        $('#firstName').val(res.data.firstname);
        $('#lastName').val(res.data.lastname);
        $('#userName').val(res.data.username);

        res.departments.forEach(function(dept){
            $('#department').append(new Option(dept.name, dept.id));
        });
        $('#department option[value=' + res.data.department + ']').attr('selected', 'selected');

        res.usergroups.forEach(function(group){
            $('#userGroup').append(new Option(group.name, group.id));
        });
        $('#userGroup option[value=' + res.data.usergroup + ']').attr('selected', 'selected');

    });

});
