<!DOCTYPE html>
<html>
    <head>
        <title> 
            JFTP ~ <?php session_start(); echo $_SESSION['working_dir']; ?> 
        </title>
        <link href = "https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel = "stylesheet">
        <link href = "../style/main_style.css" rel = "stylesheet">
        <link href = "../style/list_style.css" rel = "stylesheet">
        <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type = "text/javascript" src = "utils/utils.js"></script>
    </head>

    <body id = "new_list_page">
        <div class = "align">
            <?php echo '<h1>'.$_SESSION['working_dir'].'</h1>';  ?>
        </div>

        <div class = "align">
            <?php
                require('utils/utils.php');

                if(!($conn = ftp_connect($_SESSION['ftp_server_addr'])))
                    header("Location: ../index.php");

                if(!ftp_login($conn, $_SESSION['username'], $_SESSION['password']))
                {
                    $_SESSION['login_error'] = 'Error during login';
                    header('Location: ../index.php');
                }
                
                $file_list = ftp_rawlist($conn, $_SESSION['working_dir']);

                echo '<table>'; 
                echo '  <tr>';
                echo '      <th> </th>';
                echo '      <th class = "filename_title"> Name </th>';
                echo '      <th class = "date_title"> Last modified </th>';
                echo '      <th class = "size_title"> Size </th>';
                echo '      <th class = "mode_title"> Mode </th>';
                echo '      <th class = "data_type_title"> Data type </th>';
                echo '      <th> </th>';
                echo '      <th> </th>';
                echo '  </tr>'; 
                echo '  <tr>';
                echo '      <td> <img src = "../img/list_img/dot_dir.svg"  width = "30" height = "30"> </td>';
                echo '      <td class = "filename"> <a href = "javascript:call_php(\'cwd.php\', {\'dir\':\'.\'})"> refresh </a></td>';
                echo '      <td class = "date"> ~ </td>';
                echo '      <td class = "size"> ~ </td>';
                echo '      <td class = "mode"> ~ </td>';
                echo '      <td class = "data_type"> ~ </td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '      <td> <img src = "../img/list_img/2dot_dir.svg"  width = "30" height = "30"> </td>';
                echo '      <td class = "filename"> <a href = "javascript:call_php(\'cwd.php\', {\'dir\':\'..\'})"> previous </a></td>';
                echo '      <td class = "date"> ~ </td>';
                echo '      <td class = "size"> ~ </td>';
                echo '      <td class = "mode"> ~ </td>';
                echo '      <td class = "data_type"> ~ </td>';
                echo '  </tr>'; 

                foreach($file_list as $file_info)
                {
                    echo '<tr>';

                    $tokens = preg_split('/[ ]+/', $file_info, 9);

                    $tokens[4] = convert2multiple($tokens[4]);

                    if(str_split($tokens[0])[0] === 'd')
                    {
                        echo '<td> <img src = "../img/list_img/directory.svg"  width = "30" height = "30"> </td>';
                        echo '<td class = "directoryname"> <a href = "javascript:call_php(\'cwd.php\', {\'dir\':\''.$tokens[8].'\'})" class = "directoryname_overflow">'.$tokens[8].'</a></td>';
                    }
                    else 
                    {   
                        echo '<td> <img src = "'.getExtensionImage($tokens[8]).'"  width = "30" height = "30"> </td>';
                        echo '<td class = "filename"> ';
                        echo '    <a href = "javascript:call_php';
                        echo '        (\'get.php\', {\'file\':\''.$tokens[8].'\', \'mode\':document.getElementById(\'server_mode('.$tokens[8].')\').value, \'type\':document.getElementById(\'data_type('.$tokens[8].')\').value})"';;
                        echo '       class = "filename_overflow">'.$tokens[8].'</a>';
                        echo '</td>';
                    }

                    echo '<td class = "date">'.$tokens[5].' '.$tokens[6].' '.$tokens[7].'</td>';
                    echo '<td class = "size">'.$tokens[4].'</td>';

                    if(str_split($tokens[0])[0] === 'd')
                    {
                        echo '<td class = "mode"> ~ </td>';
                        echo '<td class = "data_type"> ~ </td>';
                        echo '<td class = "delete"> <a href = "javascript:call_php(\'rmd.php\', {\'dir\':\''.$tokens[8].'\'})" class = "delete_link"> delete </a></td>';
                    }
                    else 
                    {
                        echo '<td class = "mode">';
                        echo '   <select id = "server_mode('.$tokens[8].')">';
                        echo '      <option> Passive </option>';
                        echo '      <option> Active </option>';
                        echo '   </select>';
                        echo '</td>';
                        echo '<td class = "data_type">';
                        echo '   <select id = "data_type('.$tokens[8].')">';
                        echo '      <option> Binary </option>';
                        echo '      <option> Ascii </option>';
                        echo '   </select>';
                        echo '</td>';
                        echo '<td class = "delete"> <a href = "javascript:call_php(\'del.php\', {\'file\':\''.$tokens[8].'\'})" class = "delete_link"> delete </a></td>';
                        echo '<td class = "rename"> <input type = "text" id = "rename('.$tokens[8].')" placeholder = "rename" onkeypress = "call_php_on_enter(event, \'rename.php\', {\'old\':\''.$tokens[8].'\', \'new\':document.getElementById(\'rename('.$tokens[8].')\').value})"> </td>';
                    }

                    echo '</tr>';
                }

                echo '</tr>';
                echo '<tr>';
                echo '  <td class = "file_upload_img"> <img src = "../img/list_img/add_file.svg" width = "30" height = "30"> </td>';
                echo '  <td class = "upload_file">';
                echo '      <label for = "file_upload" class = "custom_file_upload">';
                echo '          Upload a file';
                echo '      </label>';
                echo '      <input id = "file_upload" type="file"';
                echo '           onchange = "';
                echo '                upload_data = new FormData();'; 
                echo '                upload_data.append(\'file\', document.getElementById(\'file_upload\').files[0]);';
                echo '                upload_data.append(\'mode\', document.getElementById(\'file_upload_mode\').value);';
                echo '                upload_data.append(\'type\', document.getElementById(\'file_upload_type\').value);';
                echo '                call_php(\'put.php\', upload_data);';
                echo '      "/>';
                echo '  <td class = "upload_mode">';
                echo '      <select id = "file_upload_mode">';
                echo '          <option> Passive </option>';
                echo '          <option> Active </option>';
                echo '      </select>';
                echo '  </td>';
                echo '  <td class = "upload_type">';
                echo '      <select id = "file_upload_type">';
                echo '        <option> Binary </option>';
                echo '        <option> Ascii </option>';
                echo '      </select>';
                echo '  </td>';
                echo '</tr>';
                echo '<tr>';
                echo '  <td> <img src = "../img/list_img/add_dir.svg" width = "30" height = "30"> </td>';
                echo '  <td class = "make_directory"> <input type = "text" id = "make_dir" class = "make_dir_input" placeholder = "Make a directory" onkeypress = "call_php_on_enter(event, \'mkd.php\', {\'dir\':document.getElementById(\'make_dir\').value})">';
                echo '  </td>';
                echo '</tr>';
                echo '</table>'; 
                ftp_close($conn);
            ?>
        </div>
    </body>
</html>