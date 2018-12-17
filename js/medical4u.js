const INSERT_SUCCESS = '<span>New record is inserted successfully</span>';
const UPDATE_SUCCESS = '<span>The record is updated successfully</span>';
const SYSTEM_ERROR = '<span>Sorry, system error occurred</span>';

var secure = new function(){
    this.setLogin = function(){
        secure.tryLogin({ username: $('#username').val(), 
                            password: $('#password').val()}).then(function(res){
            if(res[0] == 'success'){
                $('#username').val('');
                $('#password').val('');
                checkLogin();
            }else{
                if(res[0] == 'failure'){
                    $('#msg').show().fadeOut(5000);
                }
                console.log(res[0]);
            }
        });
        
    };
    
    this.tryLogin = function(req){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../../api/set.secure.login.php',
                    data: req
                }).done(function(res){
                    return res;
                }).fail(function(res){
                    return res;
                });      
    };
    
    this.getLoginInfo = function(){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../../api/get.secure.login.php'
                }).done(function(res){
                    return res;
                }).fail(function(res){
                    return res;
                });   
    };
    
    this.logout = function(){
        return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../../api/remove.login.php'
                }).done(function(res){
                    $('#userinfo').hide();
                    $('#login-window').show();
                    window.location.href='/index.php';
                }).fail(function(res){
                    return res;
                });   
    };
    
};


//$.ajax({
//    type: 'POST',
//    dataType: 'json',
//    url: '../../api/get.secure.login.php'
//}).done(function(res){
//    if(res.username == null){
//        console.log('here');
//        if(window.location.href.indexOf('views') >- 1)
//            window.location.href="/index.php";
//    }else{
//        if(window.location.href.indexOf('views') >- 1)
//        window.location.href="/views/schedules/index.php";
//    }
//}).fail(function(res){
//    console.log(res);
//});   
//
//secure.getLoginInfo().then(function(res){
//    console.log(res);
//    if(res.username == null){
//        console.log('here');
//        if(window.location.href.indexOf('views') >- 1)
//            window.location.href="/index.php";
//    }else{
//        console.log('there');
//        window.location.href="/views/schedules/index.php";
//    }
//});

var checkLogin = function(){
    secure.getLoginInfo().then(function(o){
        if(o.username != null){
            userinfo();
            $('#userinfo_name').html('Hi, ' + o.firstname + ' ' + o.lastname);
            $('#userinfo_group').html('<sub>' + o.groupname + '</sub>');
            $('#login-window').hide();
            if(window.location.href.indexOf('views') < 0)
                window.location.href="/views/schedules/index.php";
            if(o.groupname != 'User')
                addAdminMenu();
            return true;
        }else{
//            $('#userinfo').hide();
            $('#login-window').show();
            if(window.location.href.indexOf('views') >- 1)
                window.location.href="/index.php";
            return false;
        }
    });
};

var userinfo = function(){
    var str  =  '<span id="userinfo_name"></span><br>';
        str +=  '<a href="javscript:avoid(0);" onclick="secure.logout();" style="color:#fff;"><i class="fas fa-sign-out-alt"></i> log out</a>';
    $('#user-info').append(str);
};

var addAdminMenu = function(){
    var str  =  '<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">';
        str +=  '    <span>Admin</span>';
        str +=  '    <a class="d-flex align-items-center text-muted" href="#">';
        str +=  '    <span data-feather="plus-circle"></span>';
        str +=  '    </a>';
        str +=  '</h6>';    
        str +=  '<ul class="nav flex-column">';
        str +=  '    <li class="nav-item">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/doctors/"><span data-feather="file"></span><i class="fas fa-user-md"></i> Doctors</a>';
        str +=  '    </li>';
        str +=  '    <li class="nav-item admin-menu">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/locations/"><span data-feather="file"></span><i class="fas fa-map"></i> Locations</a>';
        str +=  '    </li>';
        str +=  '    <li class="nav-item admin-menu">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/rooms/"><span data-feather="file"></span><i class="fas fa-hospital-alt"></i> Rooms</a>';
        str +=  '    </li>';
        str +=  '    <li class="nav-item admin-menu">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/departments/"><span data-feather="file"></span><i class="fas fa-folder-open"></i> Departments</a>';
        str +=  '    </li>';
        str +=  '    <li class="nav-item admin-menu">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/specialties/"><span data-feather="file"></span><i class="fas fa-briefcase-medical"></i> Specialties</a>';
        str +=  '    </li>';
        str +=  '    <li class="nav-item admin-menu">';
        str +=  '       <a class="nav-link" href="' + base_URL + 'views/users/"><span data-feather="file"></span><i class="fas fa-user"></i> Users</a>';
        str +=  '    </li>';
        str +=  '</ul>';
    $('#admin-menu').append(str);
    
}

var myProfile = function(){
    secure.getLoginInfo().then(function(o){    
        /* Save the ID value in the session and move it to the detailed screen */
        $.post('../../api/set.session.php', { idx: o.userid })
            .done(function(data){
                window.location = base_URL + 'views/users/profile.php';
            });    
    });
}

//secure.getLoginInfo().then(function(o){
//    if(o.username != null){
//        $('#userinfo_name').html('Hi, ' + o.firstname + ' ' + o.lastname);
//        $('#userinfo_group').html('<sub>' + o.groupname + '</sub>');
//        $('#userinfo').show();
//        $('#login-window').hide();
//
//    }else{
//        $('#userinfo').hide();
//        $('#login-window').show();
//
//    }
//});
//
//checkLogin().then(function(result){
//    if(!result){
//        if(window.location.href.indexOf('views') >- 1)
//            window.location.href="/index.php";
//        console.log('false');
//    }else{
//        console.log('true');
//    }
//})
//console.log('here');
checkLogin();
//console.log('here');
