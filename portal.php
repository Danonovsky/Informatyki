<?php
require_once "functions.php";
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
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Just Img!</title>
</head>

<body>
<div id="box">
    <div id="menu">
        Witaj <?php echo $_SESSION['imie_nazwisko'];?>
        <b>E-mail: </b><?php echo $_SESSION['email'];?>
        <a href="logout.php"><input type="button" value="Wyloguj się!"/></a>
    </div>
    <div id="box2">
        <div id="content">
            <a href="my_pics.php"><input type="button" value="Moje zdjęcia"/></a><br/>
            <?php main_page();?>
        </div>
        <div id="user_list">
            <?php user_list(); ?>
        </div>
    </div>
    <div id="foot">
        Ble
    </div>
</div>
</body>
</html>