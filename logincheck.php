<?php 
if(!isset($_SESSION['UID']) || $_SESSION['sessionid']!=session_id())
{
    
  logger ("[ERR] - Session called 'branchId' is empty, expecting a branch Id");
  header("Location:login.php");
  exit();
  
}

?>