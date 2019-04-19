<?php
include( $_SERVER["DOCUMENT_ROOT"] . "/resources/ReadGameLib.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/UserClass.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/library/TemplateFunctions.php");
date_default_timezone_set("America/Sao_Paulo");

$whichText="TextoDivertudo";/*changeSpacesBack($_POST["whichText"]); */
$user = $_POST["user"];
$comment = $_POST["comment"];
$whichText = $_POST["textID"];
$date=date("Y-m-d")." ".date("H-i-s");

$conn=getDB();
$stmt=$conn->prepare("INSERT INTO comments (content, user, datetim, textID) VALUES (?,?,?,?)");
$stmt->execute([$comment, $user, $date, $whichText]);

?>
