<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <title>Just Image! - Twoje Zdjęcia</title>
</head>
<body>
<h1>Twoje zdjęcia!</h1>
<a href="portal.php"><input type="button" value="Powrót"/></a>
<a href="add_photo.php"><input type="button" value="Dodaj zdjęcie!"/></a>
<a href="logout.php"><input type="button" value="Wyloguj się!"/></a>
<?php
require_once "connect.php";
$polaczenie= @new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
$sql='SELECT * FROM pics WHERE id_u='.$_SESSION['id'];
$rezultat=$polaczenie->query($sql);
?>
</body>

</html>
