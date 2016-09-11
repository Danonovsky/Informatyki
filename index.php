<?php
session_start()
?>
<!DOCTYPE HTML>
<html lang="pl">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1"/>
    <title>Portal taki do zdjęć</title>
  </head>
  <body>
    <form action="login.php" method="POST">
      Login: <input type="text" name="login"/>
      Hasło: <input type="password" name="password"/>
      <input type="submit" value="Zaloguj się"/>
    </form>
    <br/><a href="register.php">Nie posiadasz konta? Zarejestruj się!</a>
  <hr/><br/><br/>
  <center><h1>Strona do zdjęć</h1></center>
  </body>
</html>