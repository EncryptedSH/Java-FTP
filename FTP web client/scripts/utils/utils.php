<?php
    function convert2multiple($var)
    {
        $multiple = array
            (
                0  => 'B', 
                10 => 'KB', 
                20 => 'MB', 
                30 => 'GB',
                40 => 'TB'
            );

        $base = ((int)(log($var, 2)/10))*10;

        return (int)($var/(1 << $base)).$multiple[$base];
    }

    function getExtensionImage($filename)
    {   
        $extensions_list = array
            (
                '7z'    => '../img/list_img/archive_file.svg',
                'ace'   => '../img/list_img/archive_file.svg',
                'arc'   => '../img/list_img/archive_file.svg',
                'ark'   => '../img/list_img/archive_file.svg',
                'arj'   => '../img/list_img/archive_file.svg',
                'lha'   => '../img/list_img/archive_file.svg',
                'lhz'   => '../img/list_img/archive_file.svg',
                'rar'   => '../img/list_img/archive_file.svg',
                'sit'   => '../img/list_img/archive_file.svg',
                'zim'   => '../img/list_img/archive_file.svg',
                'zip'   => '../img/list_img/archive_file.svg',
                'zipx'  => '../img/list_img/archive_file.svg',
                'tar'   => '../img/list_img/archive_file.svg',
                'bz2'   => '../img/list_img/archive_file.svg',
                'tgz'   => '../img/list_img/archive_file.svg',
                'gz'    => '../img/list_img/archive_file.svg',
                'xz'    => '../img/list_img/archive_file.svg',

                'cso'   => '../img/list_img/disk_file.svg',
                'ciso'  => '../img/list_img/disk_file.svg',
                'mds'   => '../img/list_img/disk_file.svg',
                'mdf'   => '../img/list_img/disk_file.svg',
                'nrg'   => '../img/list_img/disk_file.svg',
                'iso'   => '../img/list_img/disk_file.svg',
                'udf'   => '../img/list_img/disk_file.svg',
                'img'   => '../img/list_img/disk_file.svg',

                'm4a'   => '../img/list_img/music_file.svg',
                'm4b'   => '../img/list_img/music_file.svg',
                'm4p'   => '../img/list_img/music_file.svg',
                'm4r'   => '../img/list_img/music_file.svg',
                'm4v'   => '../img/list_img/music_file.svg',
                '3gp'   => '../img/list_img/music_file.svg',
                'mp4'   => '../img/list_img/music_file.svg',
                'aac'   => '../img/list_img/music_file.svg',
                'aiff'  => '../img/list_img/music_file.svg', 
                'aif'   => '../img/list_img/music_file.svg',
                'aifc'  => '../img/list_img/music_file.svg', 
                'ape'   => '../img/list_img/music_file.svg',
                'amr'   => '../img/list_img/music_file.svg',
                'wav'   => '../img/list_img/music_file.svg',
                'bwf'   => '../img/list_img/music_file.svg',
                'flac'  => '../img/list_img/music_file.svg', 
                'mid'   => '../img/list_img/music_file.svg',
                'midi'  => '../img/list_img/music_file.svg', 
                'mod'   => '../img/list_img/music_file.svg',
                'mp3'   => '../img/list_img/music_file.svg',
                'opus'  => '../img/list_img/music_file.svg', 
                'ra'    => '../img/list_img/music_file.svg',
                'ram'   => '../img/list_img/music_file.svg',
                'ogg'   => '../img/list_img/music_file.svg',
                'oga'   => '../img/list_img/music_file.svg',
                'wav'   => '../img/list_img/music_file.svg',
                'wave'  => '../img/list_img/music_file.svg', 
                'wma'   => '../img/list_img/music_file.svg',

                'doc'   => '../img/list_img/document_file.svg',
                'docx'  => '../img/list_img/document_file.svg',
                'docm'  => '../img/list_img/document_file.svg',
                'odt'   => '../img/list_img/document_file.svg',
                'fodt'  => '../img/list_img/document_file.svg',
                
                'pptx'  => '../img/list_img/presentation_file.svg',
                'pptm'  => '../img/list_img/presentation_file.svg',
                'ppt'   => '../img/list_img/presentation_file.svg',
                'ppsx'  => '../img/list_img/presentation_file.svg',
                'ppsm'  => '../img/list_img/presentation_file.svg',
                'pps'   => '../img/list_img/presentation_file.svg',
                'potx'  => '../img/list_img/presentation_file.svg',
                'potm'  => '../img/list_img/presentation_file.svg',
                'pot'   => '../img/list_img/presentation_file.svg',
                'odp'   => '../img/list_img/presentation_file.svg',
                'fodp'  => '../img/list_img/presentation_file.svg',
                
                'xls'   => '../img/list_img/spreadsheet_file.svg',
                'xlsx'  => '../img/list_img/spreadsheet_file.svg',
                'xlsm'  => '../img/list_img/spreadsheet_file.svg',
                'xlsb'  => '../img/list_img/spreadsheet_file.svg',
                'ods'   => '../img/list_img/spreadsheet_file.svg', 
                'fods'  => '../img/list_img/spreadsheet_file.svg',

                'rft'   => '../img/list_img/text_file.svg',
                'tex'   => '../img/list_img/text_file.svg',
                'txt'   => '../img/list_img/text_file.svg',

                'bmp'   => '../img/list_img/image_file.svg',
                'dib'   => '../img/list_img/image_file.svg',
                'cdp'   => '../img/list_img/image_file.svg',
                'djvu'  => '../img/list_img/image_file.svg',
                'djv'   => '../img/list_img/image_file.svg',
                'gif'   => '../img/list_img/image_file.svg',
                'gdp'   => '../img/list_img/image_file.svg',
                'jpg'   => '../img/list_img/image_file.svg',
                'jpeg'  => '../img/list_img/image_file.svg',
                'jpe'   => '../img/list_img/image_file.svg',
                'jif'   => '../img/list_img/image_file.svg',
                'jfif'  => '../img/list_img/image_file.svg',
                'jfi'   => '../img/list_img/image_file.svg',
                'jp2'   => '../img/list_img/image_file.svg',
                'j2k'   => '../img/list_img/image_file.svg',
                'jpf'   => '../img/list_img/image_file.svg',
                'jpx'   => '../img/list_img/image_file.svg',
                'jpm'   => '../img/list_img/image_file.svg',
                'mj2'   => '../img/list_img/image_file.svg',
                'png'   => '../img/list_img/image_file.svg',
                'tga'   => '../img/list_img/image_file.svg',
                'icb'   => '../img/list_img/image_file.svg',
                'vda'   => '../img/list_img/image_file.svg',
                'vst'   => '../img/list_img/image_file.svg',
                'tih'   => '../img/list_img/image_file.svg',
                'tiff'  => '../img/list_img/image_file.svg',
                'psd'   => '../img/list_img/image_file.svg',
                'webp'  => '../img/list_img/image_file.svg',
                'svg'  => '../img/list_img/image_file.svg',

                'exe'   => '../img/list_img/executable_file.svg',
                'out'   => '../img/list_img/executable_file.svg',

                'c'     => '../img/list_img/c_source.svg',

                'C'     => '../img/list_img/cpp_source.svg',
                'c++'   => '../img/list_img/cpp_source.svg',
                'cc'    => '../img/list_img/cpp_source.svg',
                'cpp'   => '../img/list_img/cpp_source.svg',
                'cxx'   => '../img/list_img/cpp_source.svg',
                'cppm'  => '../img/list_img/cpp_source.svg',

                'h'   => '../img/list_img/header_file.svg',
                'H'   => '../img/list_img/header_file.svg',
                'hh'  => '../img/list_img/header_file.svg',
                'hpp' => '../img/list_img/header_file.svg',
                'hxx' => '../img/list_img/header_file.svg',
                'h++' => '../img/list_img/header_file.svg',

                'asm' => '../img/list_img/assembly_source.svg',
                's'   => '../img/list_img/assembly_source.svg',

                'py'  => '../img/list_img/python_source.svg',
                'pyw' => '../img/list_img/python_source.svg',
                'pyz' => '../img/list_img/python_source.svg',
                'pyi' => '../img/list_img/python_source.svg',
                'pyc' => '../img/list_img/python_source.svg',
                'pyd' => '../img/list_img/python_source.svg',
                
                'java'  => '../img/list_img/java_file.svg',
                'jar'   => '../img/list_img/java_file.svg',
                'class' => '../img/list_img/java_file.svg',
                'jmod'  => '../img/list_img/java_file.svg',

                'php'   => '../img/list_img/php_source.svg',
                'phar'  => '../img/list_img/php_source.svg',
                'phtml' => '../img/list_img/php_source.svg',
                'pht'   => '../img/list_img/php_source.svg',
                'phps'  => '../img/list_img/php_source.svg',

                'cs'    => '../img/list_img/csharp_source.svg',
                'csx'   => '../img/list_img/csharp_source.svg',

                'go'    => '../img/list_img/go_source.svg',

                'js'    => '../img/list_img/javascript_source.svg',
                'cjs'   => '../img/list_img/javascript_source.svg',
                'mjs'   => '../img/list_img/javascript_source.svg',
                  
                'm'     => '../img/list_img/objectiveC_source.svg',
                'mm'    => '../img/list_img/objectiveC_source.svg',

                'plx'   => '../img/list_img/perl_source.svg',
                'pl'    => '../img/list_img/perl_source.svg',
                'pm'    => '../img/list_img/perl_source.svg',
                'xs'    => '../img/list_img/perl_source.svg',
                't'     => '../img/list_img/perl_source.svg',
                'pod'   => '../img/list_img/perl_source.svg',
                'cgi'   => '../img/list_img/perl_source.svg',
                'psgi'  => '../img/list_img/perl_source.svg',

                'rdata'    => '../img/list_img/R_source.svg',
                'rhistory' => '../img/list_img/R_source.svg',
                'rds'      => '../img/list_img/R_source.svg',
                'rda'      => '../img/list_img/R_source.svg',

                'rb' => '../img/list_img/ruby_source.svg',
                'ru' => '../img/list_img/ruby_source.svg',

                'rs'   => '../img/list_img/rust_source.svg',
                'rlib' => '../img/list_img/rust_source.svg',

                'swift' => '../img/list_img/swift_source.svg',

                'sql' => '../img/list_img/sql_file.svg',

                'html'  => '../img/list_img/markup_file.svg',
                'htm'   => '../img/list_img/markup_file.svg',
                'shtml' => '../img/list_img/markup_file.svg',
                'shtm'  => '../img/list_img/markup_file.svg',
                'xml'   => '../img/list_img/markup_file.svg',
                'css'   => '../img/list_img/markup_file.svg'
            );

        $extension = strtolower(preg_replace('/(.+\.)+|^\..+|^.+/', '', $filename));

        if(!strlen($extension) || !array_key_exists($extension, $extensions_list))
            return '../img/list_img/file.svg';

        return $extensions_list[$extension];
    }
?>