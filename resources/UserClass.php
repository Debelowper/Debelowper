<?php
class userClass
{
  //User Login
  public function userLogin($usernameEmail,$password)
  {
  try{
    $db = getDB();
    $hash_password=$password; //hash('sha256', $password); //Password encryption
    $stmt = $db->prepare("SELECT username FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND pswd=:hash_password");
    $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
    $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
    $stmt->execute();
    $count=$stmt->rowCount();
    $data=$stmt->fetch(PDO::FETCH_OBJ);
    $db = null;
    if($count)
    {
      $_SESSION['uid']=$data->username; // Storing user session value
      return true;
    }
    else
    {
    return false;
    }
  }
  catch(PDOException $e) {
  echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

  /* User Registration */
  public function userRegistration($name,$password,$email)
  {
  try
  {
    $db = getDB();
    $st = $db->prepare("SELECT username FROM users WHERE username=:username ");
    $st->bindParam("username", $name,PDO::PARAM_STR);
    $st->execute();
    $count=$st->rowCount();
    if($count<1)
    {
      $stmt = $db->prepare("INSERT INTO users(username,pswd,email) VALUES (:username,:hash_password,:email)");
      $stmt->bindParam("username", $name,PDO::PARAM_STR) ;
      $hash_password=$password; //hash('sha256', $password); //Password encryption
      $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
      $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
      $stmt->execute();
      $uid=$db->lastInsertId(); // Last inserted row id
      $db = null;
      $_SESSION['uid']=$uid;
      return true;
    }
    else
    {
    $db = null;
    return false;
    }
  }
  catch(PDOException $e) {
  echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
  }

  /* User Details */
  public function userDetails($uid)
  {
    try
    {
      $db = getDB();
      $stmt = $db->prepare("SELECT email,username FROM users WHERE username=:uid");
      $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
      return $data;
    }
    catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
  }
}
?>
