<?php
//session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="./commons/css/bootstrap.min.css" rel="stylesheet" >
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="./commons/css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include "./nav.php"; ?>
        <div class="offset-md-2 col-md-10" id="login-window">
            <div class="row login">
                <div class="offset-md-3 col-5 col-login">
                    <div class="row">
                        <div class="col-12">
                            <label for="username">USER NAME</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="USER NAME" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="password">PASSWORD</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="PASSWORD" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-outline-light form-control" onclick="secure.setLogin()">LOG IN</button>
                        </div>
                    </div>
                    <div class="row" id="msg" style="display: none;">
                        <div class="col-12">
                            <label><i class="fas fa-comments"></i> SYSTEM MESSAGE<br />Invalid User Name or Password, please try again!!!</label>
                        </div>
                    </div>
                </div>
            </div>
<!--
            <div class="row">
                <div class="col-12 text-right">
                    <button class="btn btn-outline-secondary btn-sm" onclick="loc.new();"><i class="fas fa-map"></i> New</button>
                </div>
            </div>
-->
        </div>
        <?php include_once "./bottom.php"; ?>
    </body>
</html>
