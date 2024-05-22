<?php 
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'GET')
        $directory = $_GET['dir'];
    
    else 
        $directory = $_POST['dir'];

    if($directory != '.' && $directory != '..')
        $_SESSION['working_dir'] .= ($directory.'/');
    
    else if($directory == '..')
        $_SESSION['working_dir'] = preg_replace('/([^\/]+\/)$/', '', $_SESSION['working_dir']);

    header('Location: list.php');
?>