<?php
include( $_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");

//$session_uid='';
$_SESSION['uid']='';
//if(empty($session_uid) && empty($_SESSION['uid']))
//{
$url='http://localhost/public/Index.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
//}
?>
