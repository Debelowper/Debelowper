
<?php
include( $_SERVER["DOCUMENT_ROOT"] . "/resources/ReadGameLib.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/UserClass.php");

$userClass = new userClass();
?>
<html>
<body>

<?php
//anti hack functions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["username"]);
  $pass = test_input($_POST["psw"]);
}

if(strlen($name)>1 && strlen($pass)>1 ){
  $uid=$userClass->userLogin($name,$pass);
  $url="http://localhost/public/index.php";
  header("Location: $url");
}

?><br>
</body>
</html>
