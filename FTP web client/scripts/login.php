<!DOCTYPE html>
<html>
    <head>
        <title> JFTP ~ login </title>
        <link href = "https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel = "stylesheet">
        <link href = "../style/main_style.css" rel = "stylesheet">
        <style>
            p { color: #eb2121; }
        </style>
    </head>

    <body class = "align">
        <div class = "grid">
            <div class = "form__field">
                <h1> JFTP login </h1>
            </div>
            <form action =  "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" class = "form login">
                <div class = "form__field">
                    <label for = "login__username">
                        <img src = "../img/login_img/user.svg" width = "20" height = "20"> 
                        <span class = "hidden"> Username </span>
                    </label>
                    <input id = "login__username" type = "text" name = "username" class = "form__input" placeholder = "Username" required>
                </div>

                <div class = "form__field">
                    <label for = "login__password">
                        <img src = "../img/login_img/password.svg" width = "20" height = "20"> 
                        <span class= "hidden"> Password </span>
                    </label>
                    <input id = "login__password" type = "password" name = "password" class = "form__input" placeholder = "Password" required>
                </div>
                
                <div class = "form__field">
                    <input type = "submit" value = "Log in">
                </div>
            </form> 

            <p id = "operation_login_error"> </p>

            <?php
                session_start();

                if($_SERVER['REQUEST_METHOD'] != 'POST')
                    exit;

                if(!($conn = ftp_connect($_SESSION['ftp_server_addr'])))
                    header('Location: ../index.php');

                if(!ftp_login($conn, $_POST['username'], $_POST['password']))
                    exit('<p>Incorrect username or password</p>');

                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];

                ftp_close($conn);
                header('Location: cwd.php?dir=.');
            ?>
        </div>
    </body>
</html>