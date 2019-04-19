
<?php

function check_if_logged_in(){
  if(empty($_SESSION["uid"])){
    //echo "<script> alert(`You are not logged in`);</script>";
    //      window.location.href=`http://localhost/public/Index.php`</script>";
    return false;
  }
  else{
    return true;
  }
}

function check_login(){
  if(empty($_SESSION["uid"])){
    echo "<script> alert(`You are not logged in`);
          window.location.href=`http://localhost/public/Index.php`</script>";
  }
}

//anti-hack function
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
