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
    Our World In Your Photos!</br><br/>
    <form action="zaloguj.php" method="POST">
        Login:<br/> <input type="text" name="login"/><br>
        Hasło:<br/> <input type="text" name="haslo"/><br>
        <input type="submit" value="Zaloguj się"/><br><br>
        <a href="rejestracja.php">Rejestracja - załóż darmowe konto!</a><br/><br/>
    </form>

    <?php
        if (isset($_SESSION['blad']))
        {
            echo $_SESSION['blad'];
        }
    ?>


</body>

</html>
