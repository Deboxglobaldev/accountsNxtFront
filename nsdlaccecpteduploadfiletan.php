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
			
			if(strpos($myrecord[1],'TAN') !== false || strpos($myrecord[1],'TCD') !== false) {
			$j=0;
			$jsonData='';
			$resultnew = '';
			for($i=1; $i<$TotalUpload; $i++)
			{
			
				//$ValueString = str_replace("'","''",$myrecord[$i]);
				if (strlen(trim($myrecord[$i]))>0)
				{
					$countString = strlen($myrecord[$i]);
					//logger2("String count for:".$myrecord[$i]."->".$countString);
					//explode from -
					$dataArr =explode('-', trim($myrecord[$i]));
					$removefirst4Char = substr($dataArr[2],4);
					$first2date = substr($dataArr[0],-2);
					$monthstring = $dataArr[1];
					$yearstring = substr($dataArr[2],0,4);
					$accDate = $first2date.'-'.$monthstring.'-'.$yearstring;
					if(strlen($removefirst4Char)=='16'){
						$ackPanNumber = '0'.$removefirst4Char;
					}else{
						$ackPanNumber = $removefirst4Char;
					}
					//logger2("Received Final Acknowledgment Number: ".$ackNumber);
					$ackNumber = substr($ackPanNumber,0, 14);
					if($ackNumber!=''){
					$jsonData.= '{ 
							"AcknowledgmentNumber":"'.$ackNumber.'",
							"AcceptedDate":"'.$accDate.'" 
					},';
					}
					
					
					
				}
			}
			
			$finalJson = '{
				"Opetation":"ACC",
				"UserId":"'.$_SESSION['UID'].'",
				"ip":"'.$_SERVER["REMOTE_ADDR"].'",
				"listOfData":['.rtrim($jsonData,',').']
			 }';

			$urlhit = $serverurlapi."General/NSDLAcceptedAPI_TAN.php";
			logger2 ('JSON TO POST ON URL:  '.$urlhit.' :'.$finalJson);
			
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$urlhit);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $finalJson);
			//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:' . strlen($loadlist)));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			echo $result = curl_exec($ch);
			curl_close($ch);
			
			//$resultnew.= $result.',';
		
			//echo $finalResponse = '['.rtrim($resultnew,',').']';
				//logger2 ('Final Response:  '.$finalResponse);
			
		  
		  }else{
		  	echo '[{
				"Status": "2",
				"message": "Invalid NSDL Accecpted File Format."
			 }]';
		  }
		  
		  
		} 
	}	
}
?>