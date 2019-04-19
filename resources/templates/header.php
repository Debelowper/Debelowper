<!DOCTYPE html>

<nav class="navbar navbar-inverse" style="margin-bottom:0">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost/public/index.php">ReadingGame</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/public/index.php">Home</a></li>
        <li><a href="http://localhost/public/MakeTest.php">Create a Test</a></li>
        <li><a href="http://localhost/public/SelectText.php">Play a Game</a></li>
      </ul>
      <?php
        require_once( $_SERVER["DOCUMENT_ROOT"] . "/resources/ReadGameLib.php");
        if(check_if_logged_in()){
          echo "<ul class=\"nav navbar-nav navbar-right\">
            <li><button class=\"btn btn-link btn-lg\" id=\"btn\"><span class=\"glyphicon glyphicon-user\"></span> My Account</button></li>
            <li><a href=\"http://localhost/public/LogOut.php\"><span class=\"glyphicon glyphicon-log-out\"></span> LogOut</a></li>
          </ul>";
        }else{
          echo "<ul class=\"nav navbar-nav navbar-right\">";
          require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/LogInTemplate.php");
          echo "</ul>";
          //echo "<a href=\"http://localhost/public/index.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a>";
        }

        ?>
    </div>
  </div>
</nav>

<script>
// onclick event is assigned to the #button element.
document.getElementById("btn").onclick = function() {
  window.location.href = "http://localhost/public/UserProfile.php";
};
</script>

</body>
</html>
