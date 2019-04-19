<?php
check_login();

$conn=getDB();
?>
<html>
<body>

<?php
  $whichText=changeSpacesBack($_POST["whichText"]);

  $stmt=$conn->prepare("SELECT text FROM txtdb where txtId= ? ");
  $stmt->execute(["$whichText"]);
  $text =$stmt->fetch(PDO::FETCH_ASSOC);
  echo $text["text"];

?><br>

<p id="clock"></p>

<form action="http://localhost/public/Questions.php" method="post">
  <input style="display:none;" id="time" type="number" value="0" name="time" Min="1" Max="1200" >
  <?php echo "<input style=display:none type=text name=whichText value=$_POST[whichText]>" ?>
  <input type="submit">
</form>

<script>
var time = setInterval(Timer, 1000);
var count = 0;
function Timer(){
  count++;
  document.getElementById("time").value = count;
}
</script>

</body>
</html>

<?php
Function changeSpacesBack($s){
  while(strpos($s, "|")){
    $s[strpos($s, "|")]=" ";
  }
  return $s;
}
?>
