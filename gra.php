<?php
session_start();

  if (!isset($_SESSION['zalogowany']))
  {
    header('Location: index.php');
    exit();
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
  <?php



  echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
  echo "<p> <b>Drewno </b>".$_SESSION['drewno'];
  echo " <b>Kamień </b>".$_SESSION['kamien'];
  echo "<b> Zboże </b>".$_SESSION['zboze']."</p>";

    echo "<p> <b><b>E-mail </b>".$_SESSION['email'];
    echo "<p> <b><b>Dni Premium: </b>".$_SESSION['dnipremium'];

  ?>

  </body>
</html>