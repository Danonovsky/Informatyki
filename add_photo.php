<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <title>Just Image! - dodaj zdjęcie</title>
</head>
<body>
</body>
</html>
