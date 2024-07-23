<?php
include "inc.php";
include "logincheck.php";
if($_POST['action']=="exportbatch"){
	
	//echo '<pre>'; print_r($_POST); die;
	$ackJson = '';
	$filepath = '';
	$ack = '';
	foreach($_POST['acknowledgmentchecksingle'] as $AcknowledgementNumber){
		$ackJson.= '{"AcknowledgementNumber":"'.$AcknowledgementNumber.'"},';
	}
	$ack = $AcknowledgementNumber;
	 
	$jsonPost = '{
		"UserId":"'.$_SESSION['UID'].'",
		"ip":"'.$_SERVER["REMOTE_ADDR"].'",
		"ListOfACKO":['.rtrim($ackJson,',').']
	}';
	
	logger("JSON to post for batch generation----".$jsonPost);
	$path = 'data/temp/batchzip/';
	
	$ackLength = strlen($ack);
	
	
	 if($ackLength==14){
	 	$url = $serverurlapi."BatchGeneration/BatchDataTanAPI.php";
		
		logger("JSON POST ON URL: ".$url);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($response);
		
		logger("Response fron batch generation api---".$response);
		
		foreach($res->BatchCreationResult as $objBatchData){
			$filename = $objBatchData->BactID; 
			$headerdata = $objBatchData->BatchHeader;
			
			$file_to_write = $filename.'.txt';
			if(is_dir($filename)){
				$batchfolder = $filename;
			}else{
				$batchfolder = mkdir($filename);
			}
			
			$file = fopen($filename . '/' . $file_to_write,"w");
			fwrite($file, $headerdata."\n");
			
			foreach($objBatchData->BatchData as $BatchDataNew){
				$AcknowledgementNumber = $BatchDataNew->AcknowledgementNumber;
				$BatchString = $BatchDataNew->BatchString;
				
				fwrite($file, $BatchString."\n");
			}
			
			// closes the file
			fclose($file);
			
			///Create zip file
			$zip = new \ZipArchive();
			$filename123 = $path."Religara_".$filename.".zip";
			
			
			if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$filename123>\n");
			}
			
			$dir = ''.$filename.'/';
			
			//function to Create zip
			createZip($zip,$dir);
			
			$zip->close();
			
			///Download zip file
			$filenamenew = "Religara_".$filename.".zip";
			$filepath.= $path."Religara_".$filename.".zip".'+';
			
			 
			//delete file
			//unlink($filename123);
			unlink($filename.'/'.$file_to_write);
			rmdir($filename);
			
			
			
		}
		
	 }else if($ackLength==15){
	 	$url = $serverurlapi."BatchGeneration/BatchDataAPI.php";
		
		logger("JSON POST ON URL: ".$url);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($response);
		
		logger("Response fron batch generation api---".$response);
		
		foreach($res->BatchCreationResult as $objBatchData){
			$filename = $objBatchData->BactID; 
			$headerdata = $objBatchData->BatchHeader;
			
			$file_to_write = $filename.'.txt';
			if(is_dir($filename)){
				$batchfolder = $filename;
			}else{
				$batchfolder = mkdir($filename);
				$photoFolder = $filename.'_photo';
				$signFolder = $filename.'_Sig';
				mkdir($filename.'/'.$photoFolder);
				mkdir($filename.'/'.$signFolder);
			}
			
			$file = fopen($filename . '/' . $file_to_write,"w");
			fwrite($file, $headerdata."\n");
			
			foreach($objBatchData->BatchData as $BatchDataNew){
				$AcknowledgementNumber = $BatchDataNew->AcknowledgementNumber;
				$BatchString = $BatchDataNew->BatchString;
				
				$photopathtocopy = $filename.'/'.$photoFolder.'/'.$AcknowledgementNumber.'_Photo.Jpg';
				$signpathtocopy = $filename.'/'.$signFolder.'/'.$AcknowledgementNumber.'_Sig.Jpg';
				
				$destinationPhotoPath = 'data/temp/crop/'.$AcknowledgementNumber.'_Photo.Jpg';
				$destinationSignaturePath = 'data/temp/crop/'.$AcknowledgementNumber.'_Sig.Jpg';
				
				
				
				if(file_exists($destinationPhotoPath)){
					logger("ack photo image exist: ".file_exists($destinationPhotoPath));
					copy('data/temp/crop/'.$AcknowledgementNumber.'_Photo.Jpg',$photopathtocopy);
				}
				if(file_exists($destinationSignaturePath)){
					logger("ack signature image exist: ".file_exists($destinationSignaturePath));
					copy('data/temp/crop/'.$AcknowledgementNumber.'_Sig.Jpg',$signpathtocopy);
				}
				
				//$filephoto = $serverurl.'data/temp/crop/'.$AcknowledgementNumber.'_Photo.Jpg';
				//$file_headers = @get_headers($filephoto);
			
				//if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
				//return false; 
				//echo "file not found";
				//}else {
				//return true;  
				//copy('data/temp/crop/'.$AcknowledgementNumber.'_Photo.Jpg',$photopathtocopy);
				//copy('data/temp/crop/'.$AcknowledgementNumber.'_Sig.Jpg',$signpathtocopy);
				//}
				
				
				
				fwrite($file, $BatchString."\n");
			}
			
			// closes the file
			fclose($file);
			
			///Create zip file
			$zip = new ZipArchive();
			$filename123 = $path."Religara_".$filename.".zip";
			
			
			if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$filename123>\n");
			}
			
			$dir = ''.$filename.'/';
			
			//function to Create zip
			createZip($zip,$dir);
			
			$zip->close();
			
			///Download zip file
			$filenamenew = "Religara_".$filename.".zip";
			$filepath.= $path."Religara_".$filename.".zip".'+';
			
			/*header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-type: application/octet-stream");
			header('Content-Disposition: attachment; filename="'.$filenamenew.'"');
			header("Content-Transfer-Encoding: binary");
			//header("Content-Length: ".filesize($filepath));
			ob_end_flush();
			@readfile($filepath);
			*/
			 
			//delete file
			//unlink($filename123);
			unlink($filename.'/'.$file_to_write);
			delete_directory($filename.'/'.$photoFolder);
			delete_directory($filename.'/'.$signFolder);
			rmdir($filename);
			
			
			
		}
	 }
	
	
	/*$jsonPost = '{
		"ListOfACKO":[{"AcknowledgementNumber":"255369700314772"},{"AcknowledgementNumber":"255369700314794"},{"AcknowledgementNumber":"255369700314783"},{"AcknowledgementNumber":"633879700024200"}]
	}';*/
	 
	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Export Batch</title>
<meta name="description" content="PAN OFFICE" />
<!-- Favicon -->
<?php include 'links.php'; ?>


</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper" >
    <div style="background-color: #1e733f;background-image:linear-gradient(to right,#1e733f,#79c117);padding:3px;">
      <div class="Container-fluid">
        <div class="row strip">
          <div class="col-sm-6">
            <p class="ticker"></p>
          </div>
          <div class="col-sm-6">
            <p class="ticker"></p>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Row -->
    <div class="row">
      <div class="col-xl-12">
        <!--                              <second row>
-->
        <div id="tabledata">
          <div id="batchbutton" style="display:none;">
            <button type="submit" class="btn btn-success" style="margin-left: 31px; font-size: 12px;">Generate Batch File</button>
          </div>
          <table class="table">
            <tbody id="myTable">
              <tr>
			  <?php 
			  $var = explode('+',rtrim($filepath,'+'));
			   foreach($var as $newvar){
			   ?>
                <td class="deta"><a type="button" href="<?php echo $newvar; ?>" style="padding: 10px; background: gray; color: white;">Download Batch File(<?php echo substr($newvar, -10)?>)</a></td>
               <?php } ?>
              </tr>
            </tbody>
          </table>

          <table class="table" style="display:none;">
<thead>
<tr class="headline">
<th>Batch ID</th>
<th>Date</th>
<th style="text-align: center;">Download</th>
<th style="text-align: center;">Action</th>
</tr>
</thead>
<tbody id="">
<tr>
	<td class="deta"><a href="" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('FUV String','modelpop.php?action=exportpopup&batchId=11556565','100%','auto');" >11556565</a></td>

	<td>09-07-2021 - 11:44am</td>
	<td align="center"><a type="button" href="" style="padding: 10px; background: gray; color: white;"><i class="fa fa-download" aria-hidden="true" style="font-size: 16px;"></i> </a></td>
	<td style="text-align: center;"> <i class="fa fa-trash" style="color:red; font-size: 20px;" aria-hidden="true"></i> </td>
</tr>
 
</tbody>
</table>  
        </div>
      </div>
    </div>
  </div>
</div>
</div>





<?php include 'footer.php'; ?>    