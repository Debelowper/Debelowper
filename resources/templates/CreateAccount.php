<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <style> .error {color:red;} </style>

  <h1>Test form</h1>
  <form  action="http://localhost/public/RegAccount.php"  method="post">
    User name:<br>
    <input  type="text" name="username" required>
    <span  class="error">*</span>
<br><br>
    User email<br>
    <input  type="text" name="email" required>
    <span  class="error">* </span>
<br><br>
    User password:<br>
    <input type="password" name="psw" required>
    <span class="error">* </span>
<br><br>
    <input type="submit" value="Submit">
  </form>

</body>
