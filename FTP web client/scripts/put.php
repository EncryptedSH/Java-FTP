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

    if(!ftp_pasv($conn, ($_POST['mode'] == 'Passive') ? true : false))
    {
        ftp_close($conn);
        exit('Error -> #');
    }

    if(!ftp_put($conn, $_SESSION['working_dir'].$_FILES['file']['name'], $_FILES['file']['tmp_name'], ($_POST['type'] == 'Binary') ? FTP_BINARY : FTP_ASCII))
    {
        ftp_close($conn);
        exit('Error -> #');
    }

    ftp_close($conn);
    header('Location: list.php');
?>
