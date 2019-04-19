<?php

check_login();
$conn=getDB();
?>
<html>
<body>
<?php
$whichText=changeSpacesBack($_POST["whichText"]);

$stmt=$conn->prepare("SELECT * FROM questions where textId= ?");
$stmt->execute(["$whichText"]);
$quest =$stmt->fetch(PDO::FETCH_ASSOC);

$time = test_input($_POST["time"]);
?><br>
<form id="questions" action="http://localhost/public/Result.php" method="post">
  <?php
  echo "<input style=display:none;  type=number value=$time name=time Min=1 Max=1200>";
  echo  "<p>Please, answer the following questions:</p>";

//prints form with questions
foreach($quest as $x=>$y){
  if($x=="questID"){
    $questID=$y;
  }
  if($x=="TextId"){
    $textID=$y;
    echo "<textarea rows=1 cols=30 maxlength=30 name=whichText required style=display:none;>$textID</textarea>";
  }
  if($x == "Question"){
    echo "<p>"."$y"."</p>";
  }
  if(str_split($x,3)[0]=="alt"){
    $n=str_split($x,3)[1];
    echo "<input type=radio name="."$questID"." value=".$n." required><span>".$y."</span><br>";
  }
}
?>
  <input type="submit">
</form>
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
