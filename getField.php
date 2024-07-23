<?php 
include "inc.php";
include "logincheck.php";

include "../General/config/conn.php";

$ProductType = "'".$_REQUEST['ProductType']."'";
$FormType = "'".$_REQUEST['FormType']."'";
$FieldName = "'".$_REQUEST['FieldName']."'";

$query = 'Select "id" from panprogres."RejectionListMaster" WHERE "ProductType"='.$ProductType.' and "FormType"='.$FormType.' and UPPER("FieldName")='.strtoupper($FieldName).' ';
$sqlrun = pg_query(OpenCon(), $query);
$countrows = pg_num_rows($sqlrun);
if($countrows>0){
	?>
	<div id="failMessage" style="color:black;font-weight: 600;color: #55a227;"><?php echo 'Field Name exists for Product Type '.$ProductType.' and Form Type '.$FormType; ?></div>	
	<script>
		$(function() {
			setTimeout(function() {
				$("#failMessage").fadeOut('fast');
			}, 3000);
		});	
	</script>
	<?php } ?>