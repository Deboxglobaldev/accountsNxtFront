<?php 
include 'inc.php';
include "logincheck.php";
//include "reader.php";
require('excelreader/php-excel-reader/excel_reader2.php');
require('excelreader/SpreadsheetReader.php');

logger("****** Inside pdf1a response action ****** :");

if(isset($_FILES['file']['name']))
{
	if(!empty($_FILES['file']))
	{
		$path = "uploads/";
		$path = $path.basename( $_FILES['file']['name']);
        logger("****** upload path ****** :".$path);
		
		//File upload Type
		logger('File upload Type is: '.$_POST['uploadFileType']);
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
		{
			$baseName = basename( $_FILES['file']['name']);
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];
			logger('Upload success '.'path is : '.$path);
			
			$Reader = new SpreadsheetReader($path);
			$totalSheet = count($Reader->sheets());
			$Reader->ChangeSheet(0);
			$j=0;
			$jsonData='';
			logger("Count is: ".count($Reader));
			foreach($Reader as $row){
				$ackNumber = str_replace("'","",trim($row[0]));
				$wisdaNo = str_replace("'","",trim($row[1]));
				if(is_numeric($ackNumber) && (strlen($ackNumber)=='14' || strlen($ackNumber)=='15')){
					$jsonData.= '{ 
								"AcknowledgmentNumber":"'.$ackNumber.'",
								"WisdaNo":"'.$wisdaNo.'"
							 },';
				}		 
			}	 
				
				$finalJson = '{
								"UserId":"'.$_SESSION['UID'].'",
								"ip":"'.$_SERVER["REMOTE_ADDR"].'",
								"ProductType":"PAN",
								"listOfData":['.rtrim($jsonData,',').']
							}';
							
				$url = $serverurlapi."General/commissionNSDLAPI.php";			
				logger('JSON TO POST ON URL:  '.$urlhit.' :'.$finalJson);
				echo $result = postCurlData($url,$finalJson);
				logger ('Data Return From pdf1a response upload: '.$result);
		}else{
			echo '[{
				"Status": "2",
				"message": "File Not Uploaded"
			 }]';
		} 
	}	
}
?>