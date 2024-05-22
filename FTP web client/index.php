<?php 
    session_start();

    $_SESSION['ftp_server_addr'] = 'localhost';
    $_SESSION['working_dir'] = '/';

    if($conn = ftp_connect($_SESSION['ftp_server_addr'])) 
    {
        header('Location: scripts/login.php');
        ftp_close($conn);
    }
    else
    {
        $_SESSION = array();
        session_destroy();
        require('html/server_unreachable.html');
    }
?>
