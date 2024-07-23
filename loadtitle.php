<?php 
if($_REQUEST['action']=='loadtitle'){
$selectid = trim($_REQUEST['selectid']);
	$subcatid = trim($_REQUEST['subcatid']); ?>
<option value="">Select</option>
<?php	if($subcatid=='7' || $subcatid=='8' || $subcatid=='9'){
?>
<option value="1" <?= ($selectid=='1')? 'selected="selected"':'';?>>M/S</option>
<?php } elseif ($subcatid=='10' || $subcatid=='12') {
	?>
<option value="2" <?= ($selectid=='2')? 'selected="selected"':'';?>>Shri</option>
<option value="3" <?= ($selectid=='3')? 'selected="selected"':'';?>>Smt</option>
<option value="4" <?= ($selectid=='4')? 'selected="selected"':'';?>>Kumari</option>
<?php } }  ?>