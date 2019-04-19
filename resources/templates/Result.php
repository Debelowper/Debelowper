<?php
check_login();
$conn=getDB();
    //retrieves form info and stores it into array with player answers
  $Player_answers= $_POST;

  //stores the player`s reading time into a variable
  $whichText=$Player_answers["whichText"];
  unset($Player_answers["whichText"]);
  $time=$Player_answers["time"];
  unset($Player_answers["time"]);

  //creates an array with all the right answers in order
  $stmt=$conn->prepare("SELECT answer FROM questions WHERE textId= :whichText ");
  $stmt->bindParam(":whichText", $whichText, PDO::PARAM_STR);
  $stmt->execute();
  $Right_answers= $stmt->fetchAll(PDO::FETCH_NUM);

    //compares the arrays for the score
  $penalties=0;
  if(count($Player_answers)==count($Right_answers)){
    for($x=0;$x<count($Player_answers);$x++){
      $o=$x+1; $i="q".$o; unset($o);
      if($Player_answers[$i]!=$Right_answers[$x][0]){
        $penalties++; unset($i);
      }
    }
      //echo "score= $penalties";
  }
  $score= $penalties*100+$time;
  echo "your time is $score seconds! <br>";

    //stores the player`s score into SQL Database if you have not played before
    $stmt=$conn->prepare("SELECT DISTINCT playerID FROM scores where textID=?");
    $stmt->execute([$whichText]);
    $AlreadyPlayedList=$stmt->fetchAll(PDO::FETCH_NUM);
    $HavePlayed=0;
    foreach($AlreadyPlayedList as $x=>$y){
      if($_SESSION["uid"] == $y[0]){
        echo "You have already played this game!<br>";
        $HavePlayed=1;
      }
    }

    if(!$HavePlayed){
      $stmt=$conn->prepare("INSERT INTO scores VALUES (?,?,?,?)");
      $stmt->execute([$_SESSION["uid"], $whichText, $time, $penalties]);
    }

    //retrieves other players` scores
  $stmt=$conn->prepare("SELECT `time`, penalties from scores where textID= ?");
  $stmt->execute([$whichText]);
    //gives the number of games played, the number of penalties and the average time
  $number_played=0;
  $number_penalties=0;
  $avg_time=0;
    //each execution of fetch moves the internal pointer in the table
  while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $number_played++;
    $avg_time+=$row["time"];
    $avg_time+=$row["penalties"] *100;
    if($row["penalties"] > 0){
      $number_penalties++;
    }
  }
  $avg_time=$avg_time/$number_played;
  $avg_time=ceil($avg_time);
  echo "<script> var avg_time=".$avg_time."</script>";

  //finds the standard deviation
  $square_sum_diff=0;
  $stmt=$conn->prepare("SELECT `time`, penalties from scores where textID= ?");
  $stmt->execute([$whichText]);
  $median_array=[]; $i=0;
  while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $median_array[$i]=$x=$row["time"]+$row["penalties"]*100;
    echo "$median_array[$i]<br>";
    $i++;
    $y=$x-$avg_time; unset($x);
    $square_sum_diff+=pow($y, 2);
  }
  $stdev=sqrt($square_sum_diff/($number_played-1));
  echo "The standard deviation was: $stdev <br>";

  //finds the median
  sort($median_array);
  $median= $median_array[floor(count($median_array)/2)];
  $slowest= $median_array[count($median_array)-1];
  $record= $median_array[0];
  echo "<script> var median=".$median."</script>";
  echo "<script> var record=".$record."</script>";
  echo "<script> var slowest=".$slowest."</script>";
  //finds where you are in the bell BellCurve
  if($stdev==0){
    $position=0;
  }else{
    $position=($score-$avg_time)/$stdev;
    echo "you were $position deviations from average<br>";
  }
  $stdev=ceil($stdev);
  echo "<script>var stdev=".$stdev."</script>";
  $pos=315-$position*68;

  echo "games played $number_played, penalties received $number_penalties, tempo medio $avg_time, seu tempo $score";

?><br>

<div style="position:relative;display:inline">

  <?php echo "<img src=http://localhost/public/images/circle.png style=width:20px;height:20px;position:absolute;bottom:150px;right:"."$pos"."px; >" ?>
  <img  id="graph" src="http://localhost/public/images/BellCurve.png" style="width:500px;height:300px;display:none;">

  <canvas id="myCanvas" width="640" height="300"
style="border-style:none;">
Your browser does not support the HTML5 canvas tag.
</canvas>
</div>

<script>
window.onload = function() {
    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");
    var img = document.getElementById("graph");
   ctx.drawImage(img, 30, -20);
   ctx.font="20px Arial";
   var dist=75;
   ctx.strokeText(median,300,280);
   ctx.strokeText(median+stdev,300+dist,280);
   ctx.strokeText(median+2*stdev,300+2*dist,280);
   ctx.strokeText(median+3*stdev,300+3*dist,280);
   ctx.strokeText(median-stdev,300-dist,280);
   ctx.strokeText(median-2*stdev,300-2*dist,280);
   ctx.strokeText(median-3*stdev,300-3*dist,280);
   ctx.strokeText(record,300-4*dist,280);
   ctx.strokeText(slowest,300+4*dist,280);
};

</script>
