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

    $tmp_file = tmpfile();

    if(!ftp_fget($conn, $tmp_file, $_SESSION['working_dir'].$_POST['file'], ($_POST['type'] == 'Binary') ? FTP_BINARY : FTP_ASCII))
    {
        ftp_close($conn);
        exit('Error -> #');
    }
    
    ftp_close($conn);

    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".$_POST['file']."\""); 
    readfile(stream_get_meta_data($tmp_file)['uri']) or exit('Error -> #');

    fclose($tmp_file);
?>