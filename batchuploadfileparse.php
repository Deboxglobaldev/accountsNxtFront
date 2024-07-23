<?php 
include 'inc.php';
include "logincheck.php";

if($_REQUEST['action']=='batchfileupload'){
	if(isset($_FILES['file']['name']))
	{
		logger("***  Inside batchuploadfileparse.php " );
		if(!empty($_FILES['file']))
		{
			logger("***  Inside batchuploadfileparse.php -> IF File is not emptpy " );
			$filepath= file_get_contents($_FILES['file']['tmp_name']);
			$baseName = basename($_FILES['file']['name']);
			$baseName = explode('.',$baseName);
			$myrecord = explode("\n",$filepath);
			$TotalUpload = count($myrecord);
			//print_r($myrecord);
			$jsonData='';
			$rowonedata = explode('^',$myrecord[0]);
			for($i=1; $i<$TotalUpload; $i++){
				 $striingData = explode('^',$myrecord[$i]);
				 if($rowonedata[2]=='PAN'){
				 	$ackNumber = $striingData[67];
					$ProductType = 'PAN';
				 }
				 if($rowonedata[2]=='PCD'){
				 	$ackNumber = $striingData[56];
					$ProductType = 'PAN';
				 }
				 if($rowonedata[2]=='TAN'){
				 	$ackNumber = $striingData[41];
					$ProductType = 'TAN';
				 }
				 if($rowonedata[2]=='TCD'){
				 	$ackNumber = $striingData[46];
					$ProductType = 'TAN';
				 }
				 if($ackNumber!=''){
					$jsonData.= '{
							"BatchNo":"'.$baseName[0].'",
							"ProductType":"'.$ProductType.'",
							"AcknowledgementNumber":"'.$ackNumber.'"
					},'; 
				 }		  
			}
			
			$finaljsonData = rtrim($jsonData,',');
			echo '['.$finaljsonData.']';
		}	
	}
}
?>