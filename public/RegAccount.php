<?php

include( $_SERVER["DOCUMENT_ROOT"] . "/resources/ReadGameLib.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/UserClass.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/library/TemplateFunctions.php");

$userClass = new userClass();

//anti hack functions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $pass = test_input($_POST["psw"]);
}

if(strlen($name) && strlen($email) && strlen($pass) > 0){
  $uid=$userClass->userRegistration($name,$pass,$email);
  echo "Parabens, $name! Sua conta foi criada.";
}

?>
