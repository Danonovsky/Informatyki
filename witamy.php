<?php
    /*session_start();
if ((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
    header('Location: portal.php');
    exit();
}

    if (!isset($_SESSION['udanarejestracja']))
    {
        header('Location: rejestracja.php');
        exit();
    }
    else
    {
        unset($_SESSION['udanarejestracja']);
    }*/
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <title>Just Image! - Witamy!</title>
    </head>
<body>
<div id="box3">
    <div id="witamy">
        <h2>Dziękujemy za rejestrację w naszym serwisie! Możesz zalogować się na swoje konto</h2>
        <a href="index.php">Zaloguj się na swoje konto!</a><br><br>
    </div>
</div>
</body>
</html>
