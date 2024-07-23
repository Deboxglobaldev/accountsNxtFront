<?php
$ftp_server = "apparelerp.in";
$ftp_conn = ftp_connect($ftp_server) or die("Hello Could not connect to $ftp_server");
$ftp_username = 'apparelerp';
$ftp_userpass = '#India@2023-ERP';
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
ftp_pasv($ftp_conn, true);
$file_list = ftp_nlist($ftp_conn, ".");

    $fileExistsName = "data/temp/envfilestoupload/ISR_10589762265.csv";

    if(file_exists($fileExistsName)){

    $uploadDirectory = "/public_html/apparelerp/";
    //Upload to ftp Directory path
    $remotePath = $uploadDirectory."/ISR_10589762265.csv";
    if (ftp_put($ftp_conn,$remotePath, $fileExistsName, FTP_BINARY))
    {
        echo $imagestatus = "File Exported TO ENV Successfully!";
    }
     
    }else{
        echo $imagestatus = "File not avilable on server.";
    }
ftp_close($ftp_conn);

?>