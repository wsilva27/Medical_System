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
        url: base_URL + 'api/get.user.profile.php'
    }).done(function(res){
        secure.getLoginInfo().then(function(currentUser){
            $('#idx').val(res.data.userid);
            $('#firstName').val(res.data.firstname);
            $('#lastName').val(res.data.lastname);
            $('#userName').val(res.data.username);
            if(res.data.username != null){
                $('#userName').attr('readonly', 'readonly');
            }
            res.departments.forEach(function(dept){
                $('#department').append(new Option(dept.name, dept.id));
            });
            $('#department option[value=' + res.data.department + ']').attr('selected', 'selected');
                
            res.usergroups.forEach(function(group){
                $('#userGroup').append(new Option(group.name, group.id));
            });
            $('#userGroup option[value=' + res.data.usergroup + ']').attr('selected', 'selected');
            if(currentUser.groupname != 'SysAdmin'){
                $('#userGroup').attr('disabled', 'disabled');
                $('#list').hide();
            }

//            if(res.data.userid != '0' || )
            $('#pwd').attr('readonly', 'readonly');
        });

    });

});

var user = new function(){
    this.try = function(){
        secure.getLoginInfo().then(function(currentUser){
            var isValid = true;
            if(!validator.isNotNull($('#firstName'))) isValid = false;
            if(!validator.isNotNull($('#lastName'))) isValid = false;
            if(!validator.isNotNull($('#department'))) isValid = false;
            if(!validator.isNotNull($('#userName'))) isValid = false;
            if(!validator.isNotNull($('#userGroup'))) isValid = false;
            if(currentUser.groupname == 'SysAdmin' && isValid){
                user.isAvailable().then(function(res){
                    console.log((res.data.isavailable == 'Available' && isValid && $('#idx').val() == '0'), (isValid && $('#idx').val() != '0'));
                    if((res.data.isavailable == 'Available' && isValid && $('#idx').val() == '0') ||
                       (isValid && $('#idx').val() != '0'))
                        user.save();
                    else
                        validator.exist($('#userName'));
                });
            } else if(isValid && currentUser.groupname != 'SysAdmin'){
//                user.matchPassword().then(function(res){
//                    if(res == 'Unmatched' && isValid)
                        user.save();
//                    else
//                        validator.matched($('#pwd'));
//                });
            }
        });
    };
    
    this.save = function(){
        /* set parameter to request to save into database */
        var param = {
            idx: $('#idx').val(),
            firstname: $('#firstName').val(),
            lastname: $('#lastName').val(),
            department: $('#department').val(),
            username: $('#userName').val(),
            usergroup: $('#userGroup').val(),
            password: $('#pwd').val()
        };
        /* ajax call */
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base_URL + 'api/set.user.profile.php',
            data: param
        }).done(function(res){
            /* show message of result */
            if($('idx').val() == '0')
                $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+INSERT_SUCCESS).show().fadeOut(5000);
            else
                $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+UPDATE_SUCCESS).show().fadeOut(5000);

            $('#idx').val(res.id);
        }).fail(function(res){
            $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR + ': line113').show().fadeOut(5000);
        }); 
    };
    
    this.isAvailable = function(){
        /* set parameter to request to save into database */
        var param = {
            username: $('#userName').val()
        };
        /* ajax call */
        return  $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: base_URL + 'api/get.user.profile.isavailable.php',
                    data: param
                }).done(function(res){
                    return res;
                }).fail(function(res){
                    $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR + ': line133').show().fadeOut(5000);
                    return res;
                });         
    }
    
    this.matchPassword = function(){
        /* set parameter to request to save into database */
        var param = {
            username: $('#userName').val(),
            pwd: $('#pwd').val()
        };
        /* ajax call */
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base_URL + 'api/get.user.profile.matchpassword.php',
            data: param
        }).done(function(res){
            return res;
//            /* show message of result */
//            if($('idx').val() == '0')
//                $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+INSERT_SUCCESS).show().fadeOut(5000);
//            else
//                $('#alertinfo').html('<i class="fas fa-comments"></i> SYSTEM MESSAGE<br />'+UPDATE_SUCCESS).show().fadeOut(5000);
//
//            $('#idx').val(res.id);
        }).fail(function(res){
            $('#errorinfo').html('<i class="fas fa-comments"></i> SYSTEM INFO<br />'+SYSTEM_ERROR + ': line162').show().fadeOut(5000);
        });         
    }
}


