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
Witaj <?php echo $_SESSION['imie_nazwisko'];?> <a href="logout.php"><input type="button" value="Wyloguj się!"/></a><br/>
<a href="my_pics.php"><input type="button" value="Moje zdjęcia"/></a><br/>
<b>E-mail: </b><?php echo $_SESSION['email'];?><br/><hr/><br/>
<?php
main_page();
user_list();
?>
</body>
</html>