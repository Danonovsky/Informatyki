<?php
session_start();
require_once "connect.php";
if (!isset($_SESSION['zalogowany']) || !isset($_GET['id_odw']))
{
    header('Location: index.php');
    exit();
}
else
$polaczenie= new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
$sql='SELECT * FROM uzytkownicy WHERE id_u='.$_GET['id_odw'];
$rezultat=$polaczenie->query($sql);
if($rezultat->num_rows<1)
{
    header('Location:index.php');
    exit();
}
$dane=$rezultat->fetch_assoc();
$imie_nazwisko=$dane['imie_nazwisko'];
?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <title>Just Image!</title>
</head>
<body>
<a href="portal.php"><input type="button" value="Powrót"/></a> <a href="logout.php"><input type="button" value="Wyloguj się!"/></a><br/>
Oglądasz profil użytkownika <?php echo $imie_nazwisko; ?>. Oto jego zdjęcia:
</body>

</html>
