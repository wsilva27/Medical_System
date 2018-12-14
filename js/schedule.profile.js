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
    schedule.get().then(function(res){

        /* implement autocomplete with ajax */ 
        $('#doctorname').autocomplete({
            source: function(req, response){
                doctor.get(req.term).then(function(data){
                    try{
                        response($.map(data[0], function(item){
                            return {
                                label: item.label,
                                value: item.name,
                                id: item.id
                            };
                        }));                            
                    }catch(e){};
                });
            },
            minLength: 1,
            select: function(event, ui) {
                event.preventDefault();
                $('#doctorid').val(ui.item.id);
                $('#doctorname').val(ui.item.value);
                docloc.get(ui.item.id).then(function(response){
                    $('#location').children().remove();
                    $('#location').append(new Option('Select Location', 0));
                    if(response[0] != null){
                        response[0].forEach(function(location){
                            $('#location').append(new Option(location.address, location.id));
                        });
                    }else{
                        alert('Dr. ' + ui.item.value + ' is not able to add any new appointment temporary.');
                    }
                });
            }
        });  
        
        $('#location').change(function(){
            room.get($('#location').val()).then(function(response){
                $('#room').children().remove();
                if(response.data != null && response.data.length > 0){
                    $('#room').append(new Option('Select Room No.', null));
                    response.data.forEach(function(room){
                        $('#room').append(new Option(room.roomnumber, room.id));
                    });
                }
                else{
                    $('#room').append(new Option('N/A', null));
                }
            });
        });
        $('#scheduledate').val(res.data.scheduledate);
        $('#scheduletime').val(res.data.scheduletime);
        $('#patientid').val(res.data.patientid);
        $('#name').val(res.data.patientname);
        $('#dob').val(res.data.patientdob);
        $('#phone').val(res.data.patientphone);
        $('#doctorid').val(res.data.doctorid);
        $('#doctorname').val(res.data.doctorname);
        $('#location').val(res.data.location);
        $('#room').val(res.data.room);
        $('#note').val(res.data.schedulenotes);
        
        docloc.get(res.data.doctorid).then(function(response){
            $('#location').children().remove();
            $('#location').append(new Option('Select Location', 0));
            if(response[0] != null){
                response[0].forEach(function(location){
                    $('#location').append(new Option(location.address, location.id));
                });
                $('#location option[value=' + res.data.location + ']').attr('selected', 'selected');
            }else{
            }
        });

        room.get(res.data.location).then(function(response){
            $('#room').children().remove();
            if(response.data != null && response.data.length > 0){
                $('#room').append(new Option('Select Room No.', null));
                response.data.forEach(function(room){
                    $('#room').append(new Option(room.roomnumber, room.id));
                });
                $('#room option[value=' + res.data.room + ']').attr('selected', 'selected');
            }
            else{
                $('#room').append(new Option('N/A', null));
            }
        });
    
    });
    


});

$(function(){
    /* implement autocomplete with ajax */ 
    $('#name').autocomplete({
        source: function(req, res){
            patient.getByName(req.term).then(function(data){
                try{
                    res($.map(data[0], function(item){
                        return {
                            label: item.label,
                            value: item.name,
                            id: item.id,
                            name: item.name,
                            dob: item.dob,
                            phone: item.phone
                        }
                    }));                            
                }catch(e){}
            });
        },
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#patientid').val(ui.item.id);
            $('#name').val(ui.item.name);
            $('#dob').val(ui.item.dob);
            $('#phone').val(ui.item.phone);
        }
    });    

    $('#phone').autocomplete({
        source: function(req, res){
            patient.getByPhone(req.term).then(function(data){
                try{
                    res($.map(data[0], function(item){
                        return {
                            label: item.label,
                            value: item.name,
                            id: item.id,
                            name: item.name,
                            dob: item.dob,
                            phone: item.phone
                        }
                    }));                            
                }catch(e){}
            });
        },
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            $('#patientid').val(ui.item.id);
            $('#name').val(ui.item.name);
            $('#dob').val(ui.item.dob);
            $('#phone').val(ui.item.phone);
        }
    });
    
});

var docloc = new function(){
    this.get = function(req){
        return $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: '../../api/get.doctorlocation.php',
                    data: { id: req },
                    success: function(res){
                        return res;
                    },
                    error: function(data){
                        $('#doctorname').removeClass('ui-autocomplete-loading');
                    }
                });
    };
};

var schedule = new function(){
    this.get = function(){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: '../../api/get.schedule.profile.php'
                }).done(function(res){
                    return res;
                });
    };
    
    this.save = function(){
        if(validator.isNotNull($('#name')) && validator.isNotNull($('#dob')) && validator.isNotNull($('#phone')) && 
           validator.isNotNull($('#doctorname')) && validator.isNotNull($('#scheduledate')) && validator.isNotNull($('#scheduletime'))){
            /* set parameter to request to save into database */
            var param = {
                idx: $('#idx').val(),
                patientid: $('#patientid').val(),
                doctorid: $('#doctorid').val(),
                scheduledate: $('#scheduledate').val(),
                scheduletime: $('#scheduletime').val(),
                room: $('#room').val(),
                schedulenotes: $('#note').val()
            };
            /* ajax call */
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../../api/set.schedule.profile.php',
                data: param
            }).done(function(res){
                /* show message of result */
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
}

var patient = new function() {
    this.getByName = function(str){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    //contentType: 'application/json',
                    data: {search: str},
                    url: '../../api/get.patient.profilebyname.php'
                }).done(function(res){
                    return res;
                });        
    };

    this.getByPhone = function(str){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    //contentType: 'application/json',
                    data: {search: str},
                    url: '../../api/get.patient.profilebyphone.php'
                }).done(function(res){
                    return res;
                });        
    };
}

var doctor = new function(){
    this.get = function(req){
        return $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    //contentType: 'application/json',
                    url: '../../api/get.doctor.profilebyname.php',
                    data: { search: req }
                }).done(function(res){
                    return res;
                });
    };
};

var room = new function(){
    this.get = function(req){
        return $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    //contentType: 'application/json',
                    data: {id: req},
                    url: '../../api/get.roombylocid.php'
                }).done(function(res){
                    return res;
                });
    };
}