<?php 
// get url
include "inc.php";
include "logincheck.php";

if($_POST['action']=="rejectionexport"){
$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
$toDate = date('Y-m-d',strtotime($_POST['toDate']));
$productType = trim($_POST['productType']);
$jsonPost = '{
    "fromDate":"'.$fromDate.'",
    "toDate":"'.$toDate.'",
	"productType":"'.$productType.'"
}';

$url = $serverurlapi."HOOperation/NSDLintimationAPI.php";
$response = postCurlData($url,$jsonPost);
logger("RESPONSE RETURN OF REJECTION BATCH: ".$response);
$res = json_decode($response);

$path = 'data/temp/rejectionbatchzip/';
$DflagSequence = $res->DflagSequence;
$IflagSequence = $res->IflagSequence;
$RflagSequence = $res->RflagSequence; 
$foldername = $res->foldername;

if(is_dir($foldername)){
	$batchfolder = $foldername;
}else{
	$batchfolder = mkdir($foldername);
}

$Dflag_write = 'D-Flag_RG'.date('dmY').$DflagSequence.'.txt';
$Iflag_write = 'I-Flag_RG'.date('dmY').$IflagSequence.'.txt';
$Rflag_write = 'R-Flag_RG'.date('dmY').$RflagSequence.'.txt';

$D_file = fopen($foldername . '/' . $Dflag_write,"w");
$I_file = fopen($foldername . '/' . $Iflag_write,"w");
$R_file = fopen($foldername . '/' . $Rflag_write,"w");
	logger('******LOOP START BATCH REJECTION*******');		

		$Dflag_String = $res->Dflag;
		$Iflag_String = $res->Iflag;
		$Rflag_String = $res->Rflag;
		
		if($Dflag_String!=''){
			fwrite($D_file, $Dflag_String."\n");
		}
		if($Dflag_String!=''){
			fwrite($I_file, $Iflag_String."\n");
		}
		if($Dflag_String!=''){
			fwrite($R_file, $Rflag_String."\n");
		}
	logger('******LOOP ENDS BATCH REJECTION*******');
	// closes the file
	fclose($D_file);
	fclose($I_file);
	fclose($R_file);
	
	///Create zip file
	$zip = new \ZipArchive();
	$filename123 = $path.$foldername.".zip";
	
	logger('zip file path: '.$filename123);
	
	if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
		exit("cannot open <$filename123>\n");
	}
	logger('after zip exit and above zip function. ');
	
	$dir = ''.$foldername.'/';
	//function to Create zip
	createZip($zip,$dir);
	logger('after zip create function.');
	$zip->close();
	
	///Download zip file
	$filenamenew = $foldername.".zip";		
	
	//delete file
	//unlink($filename123);
	unlink($foldername.'/'.$Dflag_write);
	unlink($foldername.'/'.$Iflag_write);
	unlink($foldername.'/'.$Rflag_write);
	rmdir($foldername);
	
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-type: application/octet-stream");
	header('Content-Disposition: attachment; filename="'.$filenamenew.'"');
	header("Content-Transfer-Encoding: binary");
	//header("Content-Length: ".filesize($filepath));
	ob_end_flush();
	@readfile($filename123);
	unlink($filename123);
	
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Export NSDL Rejection</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper">
    
    <section>
    <div class="container-fluid">
		<form action="" method="post" />
		  <div class="row gy-bvc" style="">
			<div class="col-md-3">
			  <div class="search-input-grid">
				<h6 style="font-weight: initial;">From&nbsp;Date</h6>
				<input type="text" name="fromDate" id="fromDate" class="form-control datepicker" value="" maxlength="10"  placeholder="DD-MM-YYYY" autocomplete="off" required >
			  </div>
			</div>
			<div class="col-md-3">
			  <div class="search-input-grid">
				<h6 style="font-weight: initial;">To&nbsp;Date</h6>
				<input type="text" name="toDate" id="toDate" class="form-control datepicker" value="" maxlength="10"  placeholder="DD-MM-YYYY" autocomplete="off" required >
			  </div>
			</div>
			<div class="col-md-3">
			  <div class="search-input-grid">
				<h6 style="font-weight: initial;">Product&nbsp;Type</h6>
				<select class="form-control" name="productType" id="productType" required>
					<option value="">Select</option>
					<option value="PAN" <?php if($_GET['productType']=='PAN'){ echo "selected"; }?>>PAN</option>
					<option value="TAN" <?php if($_GET['productType']=='TAN'){ echo "selected"; }?>>TAN</option>
				</select>
			  </div>
			</div>
			<div class="col-md-4">
			  <div class="search-input-grid">
			  <h6>&nbsp;</h6>
			 <div class="search-button">
			 	<input type="hidden" name="action" value="rejectionexport" >
				  <input type="submit" name="Search" class="btn btn-success" value="Search" />
			  </div>
			</div>
			</div>
		  </div>
		</form>
     </div> 
      </section>
      <div class="container-fluid">
        
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
<script>
var $jqDate28 = jQuery('input[name="fromDate"]');
//Bind keyup/keydown to the input
$jqDate28.bind('keyup','keydown', function(e){
  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
  if(e.which !== 8) { 

    let numChars = $jqDate28.val().length;
    if(numChars === 2 || numChars === 5){
      let thisVal = $jqDate28.val();
      thisVal += '-';
      $jqDate28.val(thisVal);
    }
  }
});
var $jqDate29 = jQuery('input[name="toDate"]');
//Bind keyup/keydown to the input
$jqDate29.bind('keyup','keydown', function(e){
  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
  if(e.which !== 8) { 

    let numChars = $jqDate29.val().length;
    if(numChars === 2 || numChars === 5){
      let thisVal = $jqDate29.val();
      thisVal += '-';
      $jqDate29.val(thisVal);
    }
  }
});

$( function() {
$( ".datepicker" ).datepicker({ 
dateFormat: 'dd-mm-yy',
maxDate: 0
});
} );
</script>
</body>
</html>
<style>
  .ui-select{
    padding: 2%;
  }
  .hgt th{
    text-align: center;
    font-weight: bold;
  }
  .hgte td{
    text-align: center;
  }
  .gvre{
        display: flex;
    column-gap: 10px;
  }
  .lk-kl{
  width: fit-content;
    margin-left: auto;
    column-gap: 50px;
  }
  .pd-btn{
    padding: 3px 40px;
  }
  .pd-btn2{
    padding: 3px 80px;
  }
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .search-input-grid{
     display: grid;
    grid-gap: 5px;
  }
  .search-button{
      display: grid;
    grid-template-columns: auto auto;
    grid-gap: 20px;
  }
  .vcx-i{
    border-top: 2px solid;
    border-bottom: 2px solid;
  }
  .ht-jy{

    margin-top:7%;
  }
.inp-wuui{
  margin: 3px;
}
.gy-bvc{
  margin: 1%;
}
.nn-mb{
  margin-top: 3%;
}
.inp-w{
  width: 90%;
}
.uyt td{
  border: none;
}
</style>
<!--search filter-->
<script>
function searchingName(){
    var name = $("#bname").val().toLowerCase();
    $("#tablesearch tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(name) > -1)
    });
}
</script>
