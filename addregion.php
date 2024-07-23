<?php 
// get url
include 'inc.php';
include "logincheck.php";

$InfoMessage = "[Info] - File location ".$_SERVER['PHP_SELF']." Message:- " ;
logger($InfoMessage."At begining of Call");

if(isset($_GET['editId'])!=''){
logger($InfoMessage."Call for Retrival ");

$url = "".$serverurlapi."General/regioninfoList.php?editId=".$_GET['editId']."";

logger($InfoMessage." Retrival API Call ..".$url );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$result = curl_exec($ch);
$regionData = json_decode($result, true);
logger($InfoMessage." JSON Retsult for Data Retrival ..".$regionData );
curl_close($ch);
}

?>
<?php 
//insert vendor information
if(isset($_POST['addregioninfo'])){
logger($InfoMessage." Data Save .." );

$formData = array(
         'editId' => $_POST['editId'],
		 'Name' => $_POST['Name'],
		 'Code' => $_POST['Code'],
		 'Status' => $_POST['Status'],
		 
   );
$insertData = http_build_query($formData);
logger($InfoMessage." Saving Data as  .. ".$insertData );
//use curl method
$ch = curl_init();
$url = "".$serverurlapi."General/addregionbasicInfo.php";
logger($InfoMessage." Saving Data URL  .. ".$url );
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data;'));
$resultData = curl_exec($ch);
logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
//print_r($resultData);die();
curl_close($ch);
$_SESSION['error']=$resultData;
}
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>PAN Dashboard</title>
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
  <form action="" method="post" />
  <div class="hk-pg-wrapper"  style="">
    <?php if(isset($_SESSION['error'])!=''){ ?>
		  <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;"> 
			<!-- Success Alert -->
			<div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;">
				 <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
		    </div>
		  </div>
  <?php } ?>
   
    <section class="">
      <div class="container-fluid full-bd">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                  <div class="input-grid">
                  <h5>Region&nbsp;Code</h5>
             <input type="number" autocomplete="off" name="Code" id="Code" required class="inp-t" value="<?php echo $regionData['Code']; ?>">
              </div>
            </div>
            <div class="col-md-4">
                  <div class="input-grid">
                  <h5>Region&nbsp;Name</h5>
             <input type="text" autocomplete="off" name="Name" id="Name" required class="inp-t" value="<?php echo $regionData['Name']; ?>">
              </div>
            </div>
            <div class="col-md-4">
                  <div class="input-grid">
                  <h5>Status</h5>
             <select name="Status" id="Status" class="inp-w ui-select wd-tr">
               <option value="1">Active</option>
               <option value="0">Inactive</option>
             </select>
              </div>
            </div>
              </div>
            </div>
          </div>
      </div>
      <hr class="dot-row">
    </section>
    <section>
      <div class="nxrt full-bd" style="width: fit-content;">
	    <input type="hidden" name="editId" value="<?php echo $regionData['Id']; ?>" />
        <input type="submit" name="addregioninfo" id="btnsubmit" class="next" value="Save">
        <input type="button" onClick="window.location.href='listregion.php'" class="next" value="Exit">

      </div>
    </section>
  </div>
    </form>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
<style>
  .jh-mn{
  margin-top: auto;
  margin-bottom: auto;
  }
  .gav th{
  text-align: center;
  }
  .hav td{
  text-align: center;
  }
  .vcx-i{
  border-top: 2px solid;
  border-bottom: 2px solid;
  }
  .addbutton{
  padding: 0%;
  width: 90px;
  color: white;
font-weight: 500;
  background: #6fb71b
  }
  .full-bd{
  padding: 2%;

  }
  .inp-t{
  width: 100%;
  height: 35px;
  outline: none;
  }
  .dot-row{
  border-top: 1px dotted black;
  }
  .flx{
  display: flex;
  column-gap: 12px;
  }
  .ui-select{
    padding: 2%;
  }
  .wd-tr{
    width: 100%;
  }
  .input-grid{
     display: grid;
    grid-gap: 5px;
  }
  </style>