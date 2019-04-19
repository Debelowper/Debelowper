
<?php
check_login();

$conn = getDB();

$stmt=$conn->prepare("SELECT * FROM txtdb");
$stmt->execute();
?>

<input type="search" placeholder="Search">
<button>Submit</button><br><br>

<form action="http://localhost/public/Text.php" method="post">
  <?php
while($textList=$stmt->fetch(PDO::FETCH_NUM)){
  foreach($textList as $x=>$y){
    if(!$x){
      $title=changeSpaces($y);
      echo "<input type=radio name=whichText value="."$title"." required>
      <label>"."$y"."</label><br>";
    }
  }
}
?>
<input type="submit">
</form>

<?php
Function changeSpaces($s){
  while(strpos($s, " ")){
    $s[strpos($s, " ")]="|";
  }
  return $s;
}

?>
