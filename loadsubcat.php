<?php
if($_REQUEST['action']=='loadsubcat'){
	$selectid = trim($_REQUEST['selectid']);
	$catid = trim($_REQUEST['catid']);
?>
<option value="">Select</option>
<?php if($catid=='a'){ ?>
<option value="1" <?= ($selectid=='1')? 'selected="selected"':'';?>>Central Government</option>
<option value="2" <?= ($selectid=='2')? 'selected="selected"':'';?>>State Government</option>
<option value="3" <?= ($selectid=='3')? 'selected="selected"':'';?>>Local Authority (Central Govt.)</option>
<option value="4" <?= ($selectid=='4')? 'selected="selected"':'';?>>Local Authority ( State Govt.)</option>
<?php }elseif($catid=='b'){ ?>
<option value="5" <?= ($selectid=='5')? 'selected="selected"':'';?>>Statutory Body</option>
<option value="6" <?= ($selectid=='6')? 'selected="selected"':'';?>>Autunomous Body</option>
<?php }elseif($catid=='c' || $catid=='d'){ ?>
<option value="7" <?= ($selectid=='7')? 'selected="selected"':'';?>>Central Govt Co./ Corporation estd.by Central act.</option>
<option value="8" <?= ($selectid=='8')? 'selected="selected"':'';?>>State Govt Co./ Corporation estd.by State act.</option>
<option value="9" <?= ($selectid=='9')? 'selected="selected"':'';?>>Other Company.</option>
<?php }elseif($catid=='e'){ ?>
<option value="10" <?= ($selectid=='10')? 'selected="selected"':'';?>>Individual</option>
<option value="11" <?= ($selectid=='11')? 'selected="selected"':'';?>>HUF</option>
<?php }elseif($catid=='f'){ ?>
<option value="12" <?= ($selectid=='12')? 'selected="selected"':'';?>>Branch of Individual Business</option>
<option value="13" <?= ($selectid=='13')? 'selected="selected"':'';?>>Branch of HUF Business</option>
<?php } ?>
<?php } ?>