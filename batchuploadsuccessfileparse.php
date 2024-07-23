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
			for($i=1; $i<$TotalUpload; $i++){
				 $striingData = explode('^',$myrecord[$i]);
				 if($striingData[67]!=''){
					$jsonData.= '{
							"BatchNo":"'.$baseName[0].'",
							"AcknowledgementNumber":"'.$striingData[67].'"
					},'; 
				 }		  
			}
			
			$finaljsonData = rtrim($jsonData,',');
			echo '['.$finaljsonData.']';
		}	
	}
}
?>