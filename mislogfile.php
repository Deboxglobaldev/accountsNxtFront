<?php 
include("inc.php");
include "logincheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>found error</title>
<style>
    .bs-example{
        margin: 20px;        
    }
</style>
</head>
<body>
<?php
$url = "".$serverurlapi."General/getmisLogsfile.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$mislogs = json_decode($result, true);
curl_close($ch);

if(isset($mislogs['status'])=='true')
{
    echo "<pre>";
    echo $mislogs['mislogfile'];
}
?>
</body>
</html>