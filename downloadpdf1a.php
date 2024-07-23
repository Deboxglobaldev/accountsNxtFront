<?php 
// get url
include "inc.php";
include "logincheck.php";

if($_POST['action']=="searchusingackno"){

//Hit api 
$url = $serverurlapi."HOOperation/copypdfoutputTomount.php?action=copytomount";
$result2 = getCurlData($url);
logger("Return from pdfcopy API: ".$result2);

$ackNumber = trim($_POST['ackNumber']);


$expAck = explode(',',$ackNumber);
$Path = '/u01/uploads/pdf1a_files/';
$createDir = date('dmyhis');
$currDateTime = date('dmyhis');
$dirname = $Path.$currDateTime;

if(is_dir($currDateTime)){
	$copypath = $currDateTime;
}else{
	$copypath = mkdir($currDateTime);
}

$i = 1;
$isPdfExist = [];
foreach($expAck as $ackNo){
	$filename = $Path.$ackNo.'.pdf';
	$dirtocopy = $currDateTime.'/'.$ackNo.'.pdf';
	if(file_exists($filename)){
		logger("Ack pdf is exist for ack: ".$ackNo);
		copy($filename,$dirtocopy);
		array_push($isPdfExist,'yes');
	}else{
		logger("Ack pdf does not exist for ack: ".$ackNo);
		
	}

	
$i++; 
}
	$totalExist = count($isPdfExist);
	logger('file exist count is: '.$totalExist);
	if($totalExist>0){
		///Create zip file
		$zip = new \ZipArchive();
		$filename123 = $Path.'pdf_file_'.$currDateTime.'.zip';
		
		logger('zip file path: '.$filename123);
		
		if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$filename123>\n");
		}
		logger('after zip exit and above zip function. ');
		
		$dir = ''.$currDateTime.'/';
		//function to Create zip
		createZip($zip,$dir);
		logger('after zip create function.');
		$zip->close();
		
		///Download zip file
		$filenamenew = 'pdf_file_'.$currDateTime.'.zip';		
		
		
		delete_directory($currDateTime);
		
		
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
	}else{
		delete_directory($currDateTime);
		?>
		<script>alert('No File Found');</script>
		<?php
	}
	
	
}

if($_POST['action']=="searchaction"){

//Hit api
$url = $serverurlapi."HOOperation/copypdfoutputTomount.php?action=copytomount";
$result2 = getCurlData($url);
logger("Return from pdfcopy API: ".$result2);

$fromDate = trim($_POST['fromDate']);
$toDate = trim($_POST['toDate']);
$productType = trim($_POST['productType']);

$jsonPost = '{
    "fromDate":"'.date('Y-m-d',strtotime($fromDate)).'",
    "toDate":"'.date('Y-m-d',strtotime($toDate)).'",
	"ProductType":"'.$productType.'"
}';

$urltopost = $serverurlapi.'General/exportpdfbydate.php';
$responseReturn = postCurlData($urltopost,$jsonPost);

		
logger("Get Ack number from date - conversion of pdf1a ".$responseReturn);

$response = json_decode($responseReturn);		

$Path = '/u01/uploads/pdf1a_files/';
$createDir = date('dmyhis');
$currDateTime = date('dmyhis');
$dirname = $Path.$currDateTime;

if(is_dir($currDateTime)){
	$copypath = $currDateTime;
}else{
	$copypath = mkdir($currDateTime);
}

$i = 1;


$isPdfExist = [];
if($response->listOfData!=''){
	foreach($response->listOfData as $ackNumber){
		$ackNo = $ackNumber->AcknoNumber;
		$filename = $Path.$ackNo.'.pdf';
		$dirtocopy = $currDateTime.'/'.$ackNo.'.pdf';
		if(file_exists($filename)){
			logger("Ack pdf is exist for ack: ".$ackNo);
			copy($filename,$dirtocopy);
			array_push($isPdfExist,'yes');
		}else{
			logger("Ack pdf does not exist for ack: ".$ackNo);
			
		}
	
		
	$i++; 
	}
}
	$totalExist = count($isPdfExist);
	logger('file exist count is: '.$totalExist);
	if($totalExist>0){
		///Create zip file
		$zip = new \ZipArchive();
		$filename123 = $Path.'pdf_file_'.$currDateTime.'.zip';
		
		logger('zip file path: '.$filename123);
		
		if ($zip->open($filename123, ZipArchive::CREATE)!==TRUE) {
			exit("cannot open <$filename123>\n");
		}
		logger('after zip exit and above zip function. ');
		
		$dir = ''.$currDateTime.'/';
		//function to Create zip
		createZip($zip,$dir);
		logger('after zip create function.');
		$zip->close();
		
		///Download zip file
		$filenamenew = 'pdf_file_'.$currDateTime.'.zip';		
		
		
		delete_directory($currDateTime);
		
		
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
	}else{
		delete_directory($currDateTime);
		?>
		<script>alert('No File Found');</script>
		<?php
	}
	
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Export PDF/A-1a</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<?php include 'links.php'; ?>
<style>
.filterCls{
  padding: 2px;
}
table.dataTable>thead>tr>th:not(.sorting_disabled), table.dataTable>thead>tr>td:not(.sorting_disabled) {
    padding-right: 10px !important;
    padding-left: 10px !important;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px !important;
}
.headline {
    border-bottom: 4px solid #1f7140 !important;
}
.thCls{
   font-size: 15px;  font-weight: 700; color: #fff;
   
}
</style>
<!-- Favicon -->
</head>
<body>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  	<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
	<div class="hk-pg-wrapper">
	   
		<div class="container-fluid">
		  <form action="" method="POST" autocomplete="nope" />
			  <div class="row gy-bvc">
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">From&nbsp;Date</h6>
					<input type="text" name="fromDate" class="form-control datepicker" value="<?php echo $_POST['fromDate']; ?>" required readonly/>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">To&nbsp;Date</h6>
					 <input type="text" name="toDate" class="form-control datepicker" value="<?php echo $_POST['toDate']; ?>" required readonly />
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">Product</h6>
					<select name="productType" class="form-control" required>
						<option value="">Select</option>
						<option value="PAN" <?php if($_POST['productType']=="PAN"){ echo 'selected'; }?>>PAN</option>
						<!--<option value="TAN" <?php if($_POST['productType']=="TAN"){ echo 'selected'; }?>>TAN</option>-->
					</select>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
				  <input type="hidden" name="action" value="searchaction" />
					<input type="submit" name="Search" class="btn btn-success" value="Export Via Date" />
				  </div>
				</div>
			  </div>
		  </form>
		</div>
	 
	 
	 
	 <div class="container-fluid">
		  <form action="" method="POST" />
			  <div class="row gy-bvc">
			  <!--<div class="col-md-3">
				  <div class="flx">
					<h6 style="font-weight: initial;">Product</h6>
					<select name="productT" id="productT" class="form-control" required>
						<option value="PAN" <?php if($_POST['productT']=="PAN"){ echo 'selected'; }?>>PAN</option>
						<option value="TAN" <?php if($_POST['productT']=="TAN"){ echo 'selected'; }?>>TAN</option>
					</select>
				  </div>
				</div>-->
				<div class="col-md-6">
				  <div class="flx">
					<h6 style="font-weight: initial;">Ack.&nbsp;Number</h6>
					<textarea name="ackNumber" class="form-control singleSpace datepicker"  placeholder="Enter Comma Seprated Ack. Number..." rows="15" required ><?php echo $_POST['ackNumber']; ?></textarea>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="flx">
				  <input type="hidden" name="action" value="searchusingackno" />
					<input type="submit" name="Search" class="btn btn-success" value="Export Via Ack. Number" />
				  </div>
				</div>
			  </div>
		  </form>
		</div>
		
<script>


	
$('.singleSpace').keyup(function() {
	var foo = this.value.replace(/\D/g, '').replace(/(\d{15})(?!$)/g, "$1,")
	var carretPos = doGetCaretPosition(this)
	
	carretPos += foo.length - this.value.length
	
	this.value = foo;
	
	//setSelectionRange(this, carretPos, carretPos)
});


	
function setSelectionRange(input, selectionStart, selectionEnd) {
	if (input.setSelectionRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
	}
	else if (input.createTextRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
		var range = input.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selectionEnd);
		range.moveStart('character', selectionStart);
		range.select();
	}
}

function doGetCaretPosition (oField) {
        
        // Initialize
        var iCaretPos = 0;
        
        // IE Support
        if (document.selection) {
            
            // Set focus on the element
            oField.focus ();
            
            // To get cursor position, get empty selection range
            var oSel = document.selection.createRange ();
            
            // Move selection start to 0 position
            oSel.moveStart ('character', -oField.value.length);
            
            // The caret position is selection length
            iCaretPos = oSel.text.length;
        }
        
        // Firefox support
        else if (oField.selectionStart || oField.selectionStart == '0')
            iCaretPos = oField.selectionStart;
         oField.focus ();
        // Return results
        return (iCaretPos);
    } 
    
    
    
    
</script>		
		
	  <div class="container-fluid">
		<!--<table class="table table-bordered " id="tableID" style="width:100% !important; ">
		  <thead>
			<tr class="headline" style="">
			  <th>Batch&nbsp;No. </th>
			  <th>Product Type</th>
			  <th>WISDA Ref#</th>
			  <th>Batch Creation Date.</th>
			  <th>Total Ack. No</th>
			  <th>Status</th>
			</tr>
		  </thead>
		  <tbody id="searchTable">
	
	<tr>
	  <td colspan="6"><div align="center">No Result Found</div></td>
	</tr>
	
		  </tbody>
		</table>-->
	  </div>
	</div>
</div>
<script>
$( function() {
	$( ".datepicker" ).datepicker({ 
		dateFormat: 'dd-mm-yy',
		maxDate: 0
	});
});
</script>
<?php include 'footer.php'; ?>
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
