<!DOCTYPE html>
<body>
  <div class="container-fluid">
    <h2>Comment section:</h2>
    <div class="col-sm-12 ">

    <?php
    date_default_timezone_set("America/Sao_Paulo");

    $conn=getDB();
    $whichText="TextoDivertudo";/*changeSpacesBack($_POST["whichText"]); */
    $num_comments=10;

    $stmt=$conn->prepare("SELECT * FROM comments where textID= ? ORDER BY datetim DESC");
    $stmt->execute([$whichText]);

    function show_comments($stmt, $num_comments){
      for($i=0; $i<$num_comments; $i++){
        if($comment =$stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<div class=\"well\">";
          echo "<span class=\"col-sm-8 text-left\">written:  ". $comment["datetim"] . "</span><br><br>";
          echo "<div class=\"well text-left\">". $comment["content"]. "</div>" ;
          echo "posted by $comment[user] " ;
          echo "</div>";
        }
      }
    }

    echo "<div style=\"overflow-y: scroll; max-height: 60vh;\">";
    show_comments ($stmt, $num_comments);
    //echo "<button>Show more</button>";
    echo "</div>";
?>


     <div class="well">
     <form action= "http://localhost/public/insertComment.php" method="post">
        <div class="form-group">
          <label for="comment">Comment:</label>
          <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="write your comment here"></textarea>
          <input type="hidden" name="textID" value=<?php echo $whichText; ?> />
          <input type="hidden" name="user" value=<?php echo $_SESSION["uid"]; ?> />
          <input type="submit" />
        </div>
      </form>
    </div>

   </div>
 </div>

</body>
