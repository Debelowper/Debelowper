<?php
check_login();
$conn=getDB();

    //Inserts questions and alternatives into db
    $quest = $_POST;
    foreach($quest as $x=>$y){
      if($x=="title"){
        $title=$y;
      }
      if($x == "text"){
        $stmt = $conn->prepare("INSERT INTO txtdb (txtId, text) VALUES (?, ?)");
        $stmt->execute([$title, $y]);
        echo "your text has been successfully inserted into DB <br>";
      }
      if(str_split($x)[0]=="q"){
        $stmt = $conn->prepare("INSERT INTO questions (questID, question, textId) VALUES (?, ?, ?)");
        $stmt->execute([$x,$y, $title]);
      }
      if(str_split($x,3)[0]=="ans"){
        $whichQuestion = "q".str_split($x,3)[1];
        $stmt = $conn->prepare("UPDATE questions SET answer= ?  WHERE questId=? and TextId=?");
        $stmt->execute([$y,$whichQuestion,$title]);
      }
      if(is_numeric($x)){
        echo "$y<br>";
        $alternative = "alt" . str_split($x)[1];
        $question = "q".$q=str_split($x)[0];
        $stmt = $conn->prepare("UPDATE questions SET $alternative= ?  WHERE questID=? and TextId=?");
        $stmt->execute([$y,$question,$title]);
      }
    }
?>
