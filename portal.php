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
    <title>Just Img!</title>
</head>

<body>
<div style="width=1000px">
    <div style="float:left; width=600px; text-align: left;">
        Witaj <?php echo $_SESSION['imie_nazwisko'];?> <a href="logout.php.php"><input type="button" value="Wyloguj się!"/></a><br/>
        <a href="my_pics.php"><input type="button" value="Moje zdjęcia"/></a><br/>
        <b>E-mail: </b><?php echo $_SESSION['email'];?><br/><hr/><br/>
        <?php main_page();?>
    </div>
    <div style="float:left; width=200 px; text-align: center;">
        <?php user_list();?>
    </div>
    <div style="clear:both"></div>
</div>
</body>
</html>