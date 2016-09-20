<?php
    session_start();

    if ((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: portal.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title>Just Image!</title>
    </head>
<body>
<div id="box3">
    Our World In Your Photos!</br><br/>
    <div id="login">
        <form action="zaloguj.php" method="POST">
            <input type="text" name="login" placeholder="Login"/><br>
            <input type="password" name="haslo" placeholder="Hasło"/><br>
            <?php
            if (isset($_SESSION['blad']))
            {
                echo '<span style="font-size: 20px;">'.$_SESSION['blad'].'</span>';
            }
            ?>
            <input type="submit" value="Zaloguj się"/><br/>
            <span style="font-size: 20px;"><a href="rejestracja.php">Rejestracja - załóż darmowe konto!</a></span>
        </form>

    </div>
</div>
</body>
</html>
