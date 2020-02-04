<?php
session_start();

//Redirect to login if not logged in
if (isset($_SESSION['status']) 
    and $_SESSION['status'] = 'loggedin') {
    $msg = "Secrets";
} else {
    header("Location:login.php?redir=secure.php");
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Open Redirection Example - Secure Page</title>
 </head>
 <body>
  <h1>Secure Page</h1>
  <p><?php echo $msg; ?> go here...</p>
 </body>
</html>
