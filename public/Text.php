<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
include( $_SERVER["DOCUMENT_ROOT"] . "/resources/ReadGameLib.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/UserClass.php");
include($_SERVER["DOCUMENT_ROOT"] ."/resources/library/TemplateFunctions.php");


$setInIndexDotPhp = "Hey! I was set in the index.php file.";
$variables = array(
        `setInIndexDotPhp` => $setInIndexDotPhp
    );
    renderLayoutWithContentFile("Text.php", $variables);
?>
