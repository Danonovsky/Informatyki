<?php
session_start();

if (!isset($_SESSION['udanarejestracja']))
{
header('Location: index.php');
exit();
}
else
{
    unset($_SESSION['udanarejestracja']);
}

?>
<!DOCTYPE HTML>
<html lang="pl">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1"/>
    <title>Osadnicy Bitch</title>
  </head>

  <body>
  <h2>Dziękujemy za rejestrację w serwisie! Możesz zalogowac się na swoje konto!</h2>

    <a href="index.php">Zaloguj się na swoje konto!</a><br/><br/>
    


  </body>
</html>