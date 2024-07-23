<?php 
//for url
include '../inc.php';

if(isset($_POST['addbranch'])){
$formData = array(
         'Name' => $_POST['name'],
		 'AddressOne' => $_POST['AddressOne'],
		 'AddressTwo' => $_POST['AddressTwo'],
		 'City' => $_POST['City'],
		 'PinCode' => $_POST['PinCode'],
		 'State' => $_POST['State'],
		 'PrimaryPhone' => $_POST['PrimaryPhone'],
		 'SecondaryPhone' => $_POST['SecondaryPhone'],
		 'PrimaryEmail' => $_POST['PrimaryEmail'],
		 'SecondaryEmail' => $_POST['SecondaryEmail'],
		 'ContactPerson' => $_POST['ContactPerson'],
		 'CenterType' => $_POST['CenterType'],
		 'AgentNumber' => $_POST['AgentNumber'],
		 'Region' => $_POST['Region'],
		 'PanNumber' => $_POST['PanNumber'],
		 'TanNumber' => $_POST['TanNumber'],
		 'GstNumber' => $_POST['GstNumber'],
		 'BranchCode' => $_POST['BranchCode'],
		 'FinancialCode' => $_POST['FinancialCode'],
		 'IfscCode' => $_POST['IfscCode'],
		 'BranchName' => $_POST['BranchName'],
		 'Status' => $_POST['Status']
   );
$insertData = http_build_query($formData);

//use curl method
$ch = curl_init();
$url = "".$serverUrl."General/addbranchbasicInfo.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$result = curl_exec($ch);
curl_close($ch);
echo $result;
}

if(isset($_POST['addbranchItem'])){
$formData = array(
         'item' => $_POST['item'],
		 'editId' => $_POST['editId'],
		 'description' => $_POST['description']
   );
$insertitems = http_build_query($formData);

//use curl method
$ch = curl_init();
$url = "".$serverUrl."General/addbranchbasicInfo.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertitems);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultitem = curl_exec($ch);
curl_close($ch);
echo $resultitem;
}
?>