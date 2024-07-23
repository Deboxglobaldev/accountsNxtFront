<?php

//echo phpinfo();

//rmdir('Invoice_1680508737');
//echo disk_free_space("/");

/*function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(":", $line);
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

echo '<pre>'; print_r(getSystemMemInfo());
*/

echo base64_encode(file_get_contents('/u01/uploads_uat/panpdf/255369700342746.pdf'));


?>