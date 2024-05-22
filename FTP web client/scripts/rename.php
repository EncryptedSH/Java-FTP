<?php
    session_start();

    if(!($conn = ftp_connect($_SESSION['ftp_server_addr'])))
    {
        $_SESSION = array();
        session_destroy();
        exit('Error -> ../index.php');
    }

    if(!ftp_login($conn, $_SESSION['username'], $_SESSION['password']))
    {
        ftp_close($conn);
        exit('Error -> login.php');
    }

    if(!ftp_rename($conn, $_SESSION['working_dir'].$_POST['old'], $_POST['new']))
    {
        ftp_close($conn);
        exit('Error -> #');
    }

    ftp_close($conn);
    header('Location: list.php');
?>