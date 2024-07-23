<?php 
include 'inc.php';
include "logincheck.php";
if(isset($_FILES['file']['name']))
{
	if(!empty($_FILES['file']))
	{
		$path = "uploads/";
		$path = $path.basename( $_FILES['file']['name']);
        logger2("****** upload path ****** :".$path);
		
		//File upload Type
		logger2('File upload Type is: '.$_POST['uploadFileType']);
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
		{
			$baseName = basename( $_FILES['file']['name']);
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];
			$fcontent = file_get_contents($path);
			
			$myrecordnew = explode(PHP_EOL,$fcontent);
			$myrecordnew = array_filter($myrecordnew);
			
			$j=0;
			$jsonData='';
			if (strpos($myrecordnew[0], 'PAN File Validation Utility')!== false) {
				$value = array();
				foreach($myrecordnew as $valuedata){
					if(trim($valuedata)!=''){
						$value[] = $valuedata;
					}
				}
				
				//print_r($value);
				//$myrecord = explode(',',$value);
				//print_r($myrecord);
				$myrecord = $value;
				$TotalUpload = count($myrecord);
				//logger2("stage file upload records .. ".count($myrecord));
				//$myrecord = array_values($myrecord);
				$resultnew = '';
				for($i=11; $i<$TotalUpload; $i++)
				{
					$three = $i+2;
					$fifth = $i+4;
				
					//$countString = strlen($myrecord[$i]);
					logger2("LINE NO ".$i." IS: ".$myrecord[$i].'<br>');
					//echo $i.'=> line is: '.$myrecord[$i].'++++';
					
					$ackNumber = trim($myrecord[$three]);
					$Message = trim($myrecord[$fifth]);
					//logger2("Received Final Acknowledgment Number: ".$ackNumber);
					if($ackNumber!='' && is_numeric($ackNumber)){
						$jsonData.= '{ 
							"AcknowledgmentNumber":"'.$ackNumber.'",
							"Message":"'.$Message.'"
						 },';
					}
					
					
					  
					$i+=4;	
				}
				
				$finalJson = '{
								"Opetation":"INS",
								"UserId":"'.$_SESSION['UID'].'",
								"ip":"'.$_SERVER["REMOTE_ADDR"].'",
								"listOfData":['.rtrim($jsonData,',').']
							}';
		
				$urlhit = $serverurlapi."General/NSDLStageUpload.php";
				logger2 ('JSON TO POST ON URL:  '.$urlhit.' :'.$finalJson);
			
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$urlhit);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $finalJson);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				
				echo $result = curl_exec($ch);
				logger($result);
				curl_close($ch);
				//$resultnew.= $result.',';
				
				//echo $finalResponse = '['.rtrim($resultnew,',').']';
				logger2 ('Final Response:  '.$result);
			
			}else{
				echo '[{
				"Status": "2",
				"message": "Invalid Batch File Format upload."
			 }]';
			}
		}else{
			echo '[{
				"Status": "2",
				"message": "File Not Uploaded"
			 }]';
		} 
	}	
}
?>