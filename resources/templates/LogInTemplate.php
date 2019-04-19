<!DOCTYPE html>

 <div id="LogInForm">
    <form  action="http://localhost/public/LogIn.php"  method=post>
      User name:<br>
      <input  type=text name=username placeholder="username" required>
      <span  class=error>*</span>
    
      User password:<br>
      <input type=password name=psw placeholder="password" required>
      <span class=error>* </span>
    <br><br>
      <input type=submit name=LoginSubmit value=Submit>
    </form>
      <form action="http://localhost/public/CreateAccount.php">
        <p>Not a member?
      <input type=submit value="Create An Account!">
  </form>
</div>
