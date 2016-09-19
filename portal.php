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
<?php



echo "<p>Witaj ".$_SESSION['user'].'! <a href="logout.php"><input type="button" value="Wyloguj się!"/></a></p>';
echo '<a href="my_pics.php"><input type="button" value="Moje zdjęcia"></a>';



echo "<p> <b>E-mail: </b>".$_SESSION['email'];
echo '<hr/><br/>';
echo '<center>';
main_page();
echo '</center>';
?>

</body>
</html>