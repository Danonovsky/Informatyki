<?php
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
<?php



echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
echo '<a href="add_photo.php"><input type="button" value="Dodaj zdjęcie"></a>';



echo "<p> <b><b>E-mail: </b>".$_SESSION['email'];


?>

</body>
</html>