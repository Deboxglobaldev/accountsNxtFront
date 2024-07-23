<?php 
include 'inc.php';
include "logincheck.php";
//RecCount=0;
if(isset($_FILES['file']['name']))
{
	logger("***  Inside mobile misuploadfile.php " );

	if(!empty($_FILES['file']))
	{
		 logger("***  Inside mobile misuploadfile.php -> IF File is not emptpy & session Id: ".$_GET['userId']);

		//RecCount++;
		$path = "uploads/";
		//$url = "".$serverurlapi."FronEnd/";
		logger("****** upload path ****** :".$path);
		$path = $path.basename( $_FILES['file']['name']);
        // logger( move_uploaded_file($_FILES['file']['tmp_name'], $path));
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
		{
			$baseName = basename( $_FILES['file']['name']);
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];
			$fcontent = file_get_contents($path);
			$handle = '{"Data":  "'.$fcontent.'"}';
			
			$myrecord = explode("\n",$fcontent);
			$striingData = explode('^',$myrecord[0]);
			$striingData[1];
		 
		 	$urlhit = $serverurlapi."General/mismobileupload.php?UserId=".$_GET['userId'].'&ip='.$_SERVER["REMOTE_ADDR"];
		 
		 	logger ('URL HIT BY MIS UPLOAD FOR mobile '.$striingData[1].' :'.$urlhit);
			//$loadlist = json_encode($handle);
			$loadlist =  trim($fcontent);
			//logger($loadlist);
		 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$urlhit);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $loadlist);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:' . strlen($loadlist)));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			echo $result = curl_exec($ch);
			logger($result);
			curl_close($ch);
			//$_SESSION['error']=$result;
		} 
	}	
}
?>