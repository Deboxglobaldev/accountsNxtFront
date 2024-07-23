<?php
  include("inc.php");
  include "logincheck.php"; 
  
  $img_r = imagecreatefromjpeg($_POST['img']);
  $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
  
  logger("Image path is: ".$_POST['img']);
  
  imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h'], $_POST['w'],$_POST['h']);
  
  $imagePath = 'data/temp/crop/'.$_POST['ackNumber'].'_'.$_POST['imgType'].'.Jpg';
  
  imagejpeg($dst_r,$imagePath,);

  $sourceProperties = getimagesize($imagePath);

  $imageSrc = imagecreatefromjpeg($imagePath); 
  $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1],$_POST['imgType']);

  imagejpeg($tmp,$imagePath,);

  $image = file_get_contents($imagePath);
  $image =substr_replace($image, pack("cnn", 1, 200, 200), 13, 5); 
  $retval = file_put_contents($imagePath,$image);
  //logger("File Put Contents Return Value: ".$retval);
  
  $encodeImage = base64_encode($image);
  //logger("File Get Contents Return Value Encoded: ".base64_encode($image));
  //$imageTag = '<img src="'.$imagePath.'">';
  //logger("IMAGE SRC: ".$imageTag );
  
  echo '[{ "ImageType":"'.$_POST['imgType'].'","ImagePath":"'.$imagePath.'","ImageTag":"'.'data:image/jpg;base64,'.$encodeImage.'" }]';
  
  
  
  exit;

?>