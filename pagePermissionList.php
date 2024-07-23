<?php
include "inc.php";
include "logincheck.php";

$url = $serverurlapi."General/userPageAPI.php";
$jsonPost = '{
	"userGroupId" : "'.decode($_GET['id']).'"
}';
$result = postCurlData($url,$jsonPost);
//logger('RESPONSE RETURN FROM USER PAGE API: '.$result);
$data = json_decode($result);
$DataTable = $data->DataTable;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Add Permission</title>
<meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
<!-- Favicon -->
<?php include 'links.php'; ?>
<script>
$(document).ready(function(){
    $('#datatable').DataTable();
} );
</script>
</head>
<body>
<style>
.custom-file-upload{
  
  padding: 8px;
 
  border-radius: 5px; 
 
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
</style>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 19px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 13px;
	width: 13px;
	left: 8px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav hk-nav-toggle">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>
  <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
  <div class="hk-pg-wrapper"  style="">
    <!-- <div style="background:transparent;">

</div> -->
    <link rel="stylesheet" href="">
    <!-- Row -->
    <div class="container-fluid"> </div>
    <div class="row contas">
      <div class="col-xl-12">
        <section class="hk-sec-wrapper contas1">
          <div class="dostas">
            <div style="display: flex;">
              <div class="dostas2"> </div>
              <h3>Add <?php echo decode($_GET['q']); ?> Permission</h3>
              <p></p>
              <div class="dostas1"> </div>
            </div>
          </div>
          <div class="container-fluid" style="margin-top:20px;">
		<table id="datatable" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr class="vcx-i hgt">
					<th>SR#</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="tablesearch">
			<?php
			$no=1;
			foreach($DataTable as $userGroup){
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $userGroup->PageName; ?></td>
					<td>
					<label class="switch" style="margin-bottom:0px !important;">
					  <input type="checkbox" id="status<?php echo $no; ?>" <?php if($userGroup->Status==1){ echo 'checked'; }?> value="<?php echo $userGroup->Status; ?>" onClick="funcPagePermission('<?php echo $no; ?>','<?php echo decode($_GET['id']); ?>','<?php echo $userGroup->Id; ?>');">
					  <span class="slider round"></span>
					</label>
					</td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		</table>
		<div id="loadspinner" style="display:none;">Loading..</div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function funcPagePermission(status,groupid,pageid){
	var status = $('#status'+status).is(':checked');
	$('#loadspinner').load('changePermission.php?action=changepermission&status='+status+'&groupid='+groupid+'&pageid='+pageid);
}
</script>
<?php include 'footer.php'; ?>
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

background: rgb(247 141 70);
    padding: 6px 8px;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    bottom: -5px;
}
.contas{
  margin-left: 0px!important;
  margin-right: 0px!important;
margin-top: 15px!important;
}
</style>
