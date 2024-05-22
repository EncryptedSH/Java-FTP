var error_message = 
{
    "cwd.php"    : "An error occurred when changing working directories. Try again.",
    "del.php"    : "An error occurred in deleting a file. Try again.",
    "get.php"    : "An error occurred while downloading a file. Try again.",
    "list.php"   : "An error occurred in the file listing. Try again.",
    "mkd.php"    : "An error occurred in the creation of the directory. Try again.",
    "put.php"    : "An error occurred in loading the file. Try again.", 
    "rename.php" : "An error occurred in renaming the file. Try again.",
    "rmd.php"    : "An error occurred when deleting the file. Try again."
}

function download_file(filename, response)
{
    var tmp_url = URL.createObjectURL(new Blob([response], {type:'application/octet-stream'}));

    var a = document.createElement('a');
    a.href = tmp_url;
    a.download = filename; 
    a.style.display = 'none';

    document.body.appendChild(a);
    a.click();

    document.body.removeChild(a);
    
    window.URL.revokeObjectURL(tmp_url);
}

function call_php_on_enter(event, php_script, parameters)
{
    if(event.keyCode !== 13)
        return;

    call_php(php_script, parameters);
}

function call_php(php_script, parameters)
{
    $.ajax
    (
        $.extend
        (
            {
                url: php_script,
                type: "POST",
                data: parameters
            },    
            (parameters instanceof FormData) ? { contentType: false, processData: false,} : {},
            (php_script == 'get.php') ? { xhrFields: { responseType: 'arraybuffer' }} : {},
            {
                success: 
                    function(response) 
                    { 
                        if(php_script == "get.php")
                        {
                            download_file(parameters["file"], response);
                            return;
                        }

                        var response_tokens = response.split(" -> ");

                        if(response_tokens[0] == "Error" && response_tokens[1] == "#")
                            window.alert(error_message[php_script]);

                        else if(response_tokens[0] == "Error")
                            window.open(response_tokens[1], "_self");
                        
                        else
                            $("#new_list_page").html(response);
                    },

                error: 
                    function(xhr, status, error) { window.alert(error_message[php_script]); }
            }   
        )
    );
}

