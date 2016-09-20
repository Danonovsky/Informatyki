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
    <link rel="stylesheet" href="style.css" type="text/css"/>
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
$ilosc=$rezultat->num_rows;
echo "<center>";
for($i=0;$i<$ilosc;$i++)
{
    $rows=$rezultat->fetch_assoc();
    $pic=$rows['img_url'];
    $data=$rows['date'];
    echo $data.'<br/>';
    echo '<img src="'.$pic.'" width="400px"/><br/>';
}
echo "</center>";
$polaczenie->close();
?>
</body>

</html>
