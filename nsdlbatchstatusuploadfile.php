<?php 
include 'inc.php';
include "logincheck.php";
if(isset($_FILES['file']['name']))
{
	
	if(!empty($_FILES['file']))
	{
		
		//RecCount++;
		$path = "uploads/";
		$url = "".$serverurlapi."FronEnd/";
		logger2("****** upload path ****** :".$path);
		$path = $path.basename( $_FILES['file']['name']);
        // logger2( move_uploaded_file($_FILES['file']['tmp_name'], $path));
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $path))
		{
		  $baseName = basename( $_FILES['file']['name']);
		  $type = $_FILES['file']['type'];
		  $size = $_FILES['file']['size'];
		  $fcontent = file_get_contents($path);
		  //$handle = '{"Data":  "'.$fcontent.'"}';
		 
		 
		 //$striingData = explode('^',$myrecord[0]);
		 //$striingData[1];
		
			$myrecord = explode(PHP_EOL,$fcontent);
			if (count($myrecord) ==1)
			{
				$myrecord = explode("\n",$filepath);
			}
			if (count($myrecord) ==1)
			{
				$myrecord = explode("\\n",$filepath);
			}
			$TotalUpload = count($myrecord);
			logger2("records .. ".count($myrecord));
			if(strpos($myrecord[1],'RESP.html') !== false || strpos($myrecord[1],'txtRejectedNot Available') !== false) {
			$j=0;
			$jsonData='';
			$resultnew = '';
			for($i=1; $i<$TotalUpload; $i++)
			{
			
				//$ValueString = str_replace("'","''",$myrecord[$i]);
				if (strlen(trim($myrecord[$i]))>1)
				{
					$countString = strlen($myrecord[$i]);
					//logger2("String count for:".$myrecord[$i]."->".$countString);
					//explode from -
					$dataArr =explode('-', trim($myrecord[$i]));
					$removefirst4Char = substr($dataArr[2],4);
					$first2date = substr($dataArr[0],-2);
					$monthstring = $dataArr[1];
					$yearstring = substr($dataArr[2],0,4);
					$batchno = substr($dataArr[2],4,6);
					$LengthWisdaNo = strlen($dataArr[0])-2;
					$finalWisdaNo = substr($dataArr[0],0,$LengthWisdaNo);
					logger2("WISDA NO LENGTH IS:".$LengthWisdaNo." AND NO# IS: ".$finalWisdaNo);
					 
					if(strpos($dataArr[2],'Accepted')!==false){
						$status = "Accepted";
					}
					if(strpos($dataArr[2],'Rejected')!==false){
						$status = "Rejected";
					}
					if(strpos($dataArr[2],'Partially Accepted')!==false){
						$status = "Partially Accepted";
					}
					if(strpos($dataArr[2],'Duplicate')!==false){
						$status = "Duplicate";
					}
					$accDate = $first2date.'-'.$monthstring.'-'.$yearstring;
					//logger2("Received Final Acknowledgment Number: ".$ackNumber);
					
					if($batchno!=''){
					$jsonData.= '{ 
							"BatchNumber":"'.$batchno.'",
							"WisdaRefNo":"'.$finalWisdaNo.'",
							"Status":"'.$status.'",
							"Date":"'.$accDate.'" 
					},';
					}
				
				
				}
			}
		
			$finalJson = '{
			"productType":"PAN",
			"UserId":"'.$_SESSION['UID'].'",
			"ip":"'.$_SERVER["REMOTE_ADDR"].'",
			"listOfData":['.rtrim($jsonData,',').']
			}';
			
			$urlhit = $serverurlapi."General/NSDLBatchStatusUpdateAPI.php";
			logger2 ('JSON TO POST ON URL:  '.$urlhit.' :'.$finalJson);
			
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$urlhit);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $finalJson);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			echo $result = curl_exec($ch);
			curl_close($ch);
			//$resultnew.= $result.',';
			//echo $finalResponse = '['.rtrim($resultnew,',').']';
			logger2 ('Final Response:  '.$result);
			
		  
		  }else{
		  	echo '[{
				"Status": "2",
				"message": "Invalid Batch Status File Format."
			 }]';
		  }
		  
		  
		} 
	}	
}
?>