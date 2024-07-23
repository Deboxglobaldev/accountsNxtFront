<?php 

include 'inc.php';
include "logincheck.php";
require('fpdf/fpdf.php');
 

//require_once("vendor/autoload.php");
//require_once("vendor/ilovepdf/ilovepdf-php/init.php");
  
function grab_image($url,$saveto){
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $raw=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($saveto)){
        unlink($saveto);
    }
    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);
}

if($_POST['action']=="dowloadpdffile"){
$batchno  = trim($_POST['batchNo']);
$productType  = trim($_POST['productType']);

$formJson = '{ "BatchId": "'.$batchno.'" }';	
logger("JSON post to download pdf: ".$formJson);

if($productType=='PAN'){
	$urlPost = $serverurlapi."General/PanPdf.php";
	$pathTo = 'panimages';
}else{
	$urlPost = $serverurlapi."General/TanPdf.php";
	$pathTo = 'tanimages';
}

$chp = curl_init();
curl_setopt($chp, CURLOPT_URL,$urlPost);
curl_setopt($chp, CURLOPT_POST,1);
curl_setopt($chp, CURLOPT_POSTFIELDS, $formJson);
curl_setopt($chp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($chp, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($chp); 
curl_close($chp);
$res = json_decode($response);

logger("Response return download pdf api: ".$response);

if($res->Fieldlist!=""){
	
	if(is_dir('pdf/'.$batchno)){
		$batchfolder = $batchno;
	}else{
		$batchfolder = mkdir('pdf/'.$batchno);
	}

	foreach($res->Fieldlist as $ackNo){
		$pdf = new FPDF();
		$AcknowledgementNumber = $ackNo->Acknowledgement;
		for($i=0; $i<=6; $i++){
			$imagePath = $serverurlapi.'BulkUpload/uploads/'.$pathTo.'/'.$AcknowledgementNumber.'_'.$i.'.jpg';
			$photopathtocopy = 'pdf/'.$batchno.'/'.$AcknowledgementNumber.'_'.$i.'.Jpg';
			logger("Image path: ".$imagePath);
			$file_headers = @get_headers($imagePath);
			if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
				//echo "file not found";
				logger("file not found for ack no: ".$AcknowledgementNumber.'_'.$i);
			}else {
				$match.= 'yes';
				logger("file found for ack no: ".$AcknowledgementNumber.'_'.$i);
				
				//Fetch image from other server
				grab_image($imagePath,$photopathtocopy);
				
				$sourceProperties = getimagesize($photopathtocopy);
				logger("image width*height: ".$sourceProperties[0].'*'.$sourceProperties[1]);
				if($sourceProperties[0]!='' && $sourceProperties[1]!=''){
				$imageSrc = imagecreatefromjpeg($imagePath); 
				$newImageLayer = imagecreatetruecolor($sourceProperties[0],$sourceProperties[1]);
				imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$sourceProperties[0],$sourceProperties[1],$sourceProperties[0],$sourceProperties[1]);
				
				imagefilter($newImageLayer, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
				imagefilter($newImageLayer, IMG_FILTER_CONTRAST, -50); 
				imagejpeg($newImageLayer,$photopathtocopy,);
				//convert image to 200 DPI
				$image = file_get_contents($photopathtocopy);
				$image =substr_replace($image, pack("cnn", 1, 200, 200), 13, 5);
				file_put_contents($photopathtocopy,$image);
				
				$image = $photopathtocopy;
				if($i=='0'){
					$width = '210';
					$height = '150';
				}else{
					$width = '210';
					$height = '290';
				}
				$pdf->AddPage();
				$pdf->Image($image,0,0,$width,$height);
				}
				
			}
			
		}
		
		
			//$pdf->Output($AcknowledgementNumber.'.pdf','D');
			$filename=	'pdf/'.$batchno.'/'.$AcknowledgementNumber.'.pdf';
			ob_start (); //used before output.
			$pdf->Output($filename,'F');
			//$dir = 'temp/';
			
			
			//$ilovepdf = new Ilovepdf('project_public_1921b21ca8e647222948158e74e8bea6_cJDry1b12fab619d05a22e3fcf739275fdc7d','secret_key_1181604f3a52f8a13618bbf281560f39_l6N380b7423f3ec62e1a4294dd0d560cf0871');
			
			// Create a new task
			//$myTask = $ilovepdf->newTask('pdfa');
			// Add files to task for upload
			//$file1 = $myTask->addFile($filename);
			// Set your tool options
			//$myTask->setConformance('pdfa-1a');
			// and set if we allow a downgrade if your conformance level fails
			//$myTask->setAllowDowngrade(false);
			// Execute the task
			//$myTask->execute();
			// Download the package files
			//$myTask->download('pdf/'.$batchno.'/');
		
		  
	}
	//delete or jpg file from directory
	$batchdir = 'pdf/'.$batchno.'/';
	array_map('unlink', glob("{$batchdir}*.Jpg"));
	
	///Create zip file
	/*$zip = new ZipArchive();
	$filename123 = "./PDF_".$batchno.".zip";
	
	if($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
		exit("cannot open <$filename123>\n");
	}
	
	$dir = ''.$batchno.'/';
	
	//function to Create zip
	createZip($zip,$dir);
	$zip->close();
	
	///Download zip file
	$filenamenew = "PDF_".$batchno.".zip";
	delete_directory($batchno);
	//unlink($filename123);
	*/
}

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Download PDF</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="background-image: url(img/Religare-Dashboard-BG.JPG);">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Row -->
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper contas1">
          <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>Download PDF</h3>
              <div class="dostas1"> </div>
            </div>
          </div>
          <?php if(isset($_SESSION['error'])!=''){ ?>
          <div class="bs-example" style="padding-top: 14px">
            <!-- Success Alert -->
            <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
          </div>
          <?php } ?>
          <form class="form-inline" action="" method="post" enctype="multipart/form-data">
            <div class="container-fluid dostas3">
              <div class="row">
                <div class="">
                  <input type="number" name="batchNo" class="form-control" id="batchNo" value="" placeholder="Enter Batch No." required>
                </div>
				<div class="" style="margin-left:10px;">
                  <select name="productType" class="form-control" required >
				  	<!--<option value="">Product Type</option>-->
				  	<option value="PAN">PAN</option>
					<option value="TAN">TAN</option>
				  </select>
                </div>
                <div class="col-md-2">
                  <h4>
                    <button type="submit" class="btn btn-default uploadbutton" id="downloadpdf">Get PDF</button>
                  </h4>
                </div>
              </div>
            </div>
			<input type="hidden" name="action" value="dowloadpdffile">
          </form>
           <div class="container bultable">
            <div id="tabledata" style="color:#00CC33;">
			<!--<?php if($res->Fieldlist!=""){ ?>
			<a type="button" href="<?php echo $serverurl.'FronEnd/'.$filenamenew; ?>" style="padding: 10px; background: gray; color: white;">Download PDF File(<?php echo $filenamenew; ?>)</a>
			<?php } ?>-->
              <form method="post" action="">
                <div id="batchbutton" style="display:none;">
                  <button type="submit" class="btn btn-success" style="font-size: 12px;">Submit Data</button>
                </div>
                <input type="hidden" name="action" value="submitbatchfile">
                <table class="table table-bordered " id="tableID" style="width:100% !important;">
                  <thead>
                    <tr class="headline" style="background: #5ea923;">
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Sr. No#</th>
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Acknowledge No.</th>
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Form Type</th>
                      <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Applicant Category</th>
					  <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Current Stage</th>
					  <th class="thCls" style=" font-size: 15px;  font-weight: 700; color: #fff;">Download</th>
                    </tr>
                  </thead>
                  <tbody id="searchTable">
				  <?php 
				  $sr = 1;
				  if($res->Fieldlist!=""){
				  foreach($res->Fieldlist as $listData){
				 	 $url = $serverurlapi."FronEnd/pdf/".$batchno."/".$listData->Acknowledgement.'.pdf';
				  ?>
                   	<tr>
						<td><?php echo $sr; ?></td>
						<td><?php echo $listData->Acknowledgement; ?></td>
						<td><?php echo $listData->FormType; ?></td>
						<td><?php echo $listData->ApplicantCategory; ?></td>
						<td><?php echo $listData->CurrentStage; ?></td>
						<td style="text-align: center !important;" align="center"><a href="<?php echo $url; ?>" target="_blank" ><i class="fa fa-download" aria-hidden="true"></i></a></td>
					</tr>
					<?php $sr++; } }else{ ?>
					<tr>
						<td colspan="6" style="text-align: center !important;" align="center">No record found.</td>
					</tr>
					
					<?php } ?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
          <div class="model-busy" style="display:none">
            <div class="center-busy"> <img alt="" src="img/Spin.gif" /> </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
/*$(document).ready(function(){

    $("#downloadpdf").click(function(){
	    $(".model-busy").show();
        // Check file selected or not
        	 $.ajax({
              url: '',
              type: 'post',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
			 	//console.log(response);
			    //const obj = JSON.parse(JSON.stringify(response));
				const list = JSON.parse(response);
				console.log(list);
                 $(".model-busy").hide();
			  },
           });
        }
    });
});*/
</script>

</body>
</html>
<style>

.submitbutton{
        background-color: rgb(247 141 70);
        width:100%;
  color:black;
    font-weight: bold;
}
.sign{
padding-right: 15px;
}
.cls{


    background:rgb(247 141 70);
    padding: 10px;
    border-radius: 50%;
    color: white;

        font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: 4px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}

.model-busy
{
position:fixed;
z-index:999;
height:100%;
width:100%;
top:0;
left:0;
background-color:black;
filter:alpha(opacity=60);
opacity:0.6;
-moz-opacity:0.8;
}
.center-busy
{
z-index:1000;
margin:300px auto;
padding:0px;
width:130px;
filter: alpha(opacity=100);
opacity:1;
-moz-opacity:1;
}
.center-busy img
{
height:128px;
width:128px;
}
</style>
