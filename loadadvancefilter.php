<?php 
session_start();
include "inc.php";

if($_REQUEST['action']=="advancedfilter"){
	$ptype = trim($_REQUEST['ptype']);
	$selectedId = trim($_REQUEST['selectedId']);

	if($ptype=="PAN"){
	?>
		<option value="">Select</option>
		<option value="AKNOWLEDGEMENT-NO">RECEIPT NUMBER</option>
		<option value="APPFNAME">APPLICANT FIRST NAME</option>
		<option value="APPMNAME">APPLICANT MIDDLE NAME</option>
		<option value="APPLNAME">APPLICANT LASTN AME</option>
		<option value="APPLICANT-CATEGORY">APPLICANT STATUS</option>
		<option value="NAMETOBEPRINTED">CARDDISPLAY NAME</option>
		<option value="PAN-NUMBER">PANNUMBER</option>
		<option value="AKNW-DATE">DateofReceipt</option>
		<option value="BATCH-NO">BatchNo</option>
		<option value="ACCEPTANCE_UPLOAD_DATE">NSDLDate</option>
		<option value="R-FLAT-BLOCKNO">Address1</option>
		<option value="R-TOWN|COUNTRY">City</option>
		<option value="R-PIN">PINDCODE</option>
		<option value="REJECTION-DATE">REJECTION DATE</option>
	<?php
	}elseif($ptype=="TAN"){
	?>
		<option value="">Select</option>
		<option value="ACKNOWLEDGEMENT-NO">RECEIPT NUMBER</option>
		<option value="OFFICE-NAME">OFFICE NAME</option>
		<option value="ORGANIZATION-NAME">ORGANIZATION NAME</option>
		<option value="COMPANY-NAME">COMPANY NAME</option>
		<option value="MNAME">Middle Name</option>
		<option value="FNAME">First Name</option>
		<option value="LNAME">Last Name</option>
		<option value="TAN-NUMBER">TAN Number</option>
		<option value="AKNW-DATE">DateofReceipt</option>
		<option value="BATCH-NO">Batch No</option>
		<option value="ADDR-TOWN|COUNTRY">City</option>
		<option value="ADDR-BUILDING-VILLAGE">Address 1</option>
		<option value="ADDR-STREET-POSTOFFICE">Address 2</option>
		<option value="ADDR-PIN">Pincode</option>
	<?php
	}
} ?>