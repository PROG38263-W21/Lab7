<?php
session_start();

//Did we just get a login form?
if (isset($_POST['submit'])) {
    if ($_POST['username'] == 'user' 
        and $_POST['password'] == 'password') {
        $_SESSION['status'] = 'loggedin';
    }
}

//If there was a redir, send them there
if (isset($_GET['redir']) 
    and isset($_SESSION['status']) 
    and $_SESSION['status'] == 'loggedin') {
    header('Location:'.$_GET['redir']);
}

?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Open Redirection Example - Login Page</title>
 </head>
 <body>
  <h1>Login</h1>
  <form action="" method="post">
   <input type="text" name="username"><br>
   <input type="password" name="password"><br>
   <input type="submit" name="submit">
  </form>
 </body>
</html>
