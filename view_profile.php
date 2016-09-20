<?php
session_start();
require_once "connect.php";
require_once "functions.php";
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
$id_usera=$_GET['id_odw'];
$sql2='SELECT * FROM pics WHERE id_u='.$id_usera;
$rezultat2=$polaczenie->query($sql2);
$ilosc=$rezultat2->num_rows;

?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Just Image! - <?php echo $imie_nazwisko; ?></title>
</head>
<body>
<div id="box">
    <div id="menu">
        <ol>
            <li><?php echo $_SESSION['imie_nazwisko'];?></li>
            <li><a href="portal.php">Strona główna</a></li>
            <li><a href="my_pics.php">Moje zdjęcia</a></li>
            <li><a href="#">O autorach</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>
        </ol>
    </div>
    <div id="box2">
        <div id="content">
            Oglądasz profil użytkownika <?php echo $imie_nazwisko.'. ';
            if($ilosc>0)
            {
                echo 'Oto jego zdjęcia: ';
            }
            else
            {
                echo 'Niestety, nie posiada on żadnych zdjęć.';
            }
            ?><br/><br/>
            <?php
            for($i=0;$i<$ilosc;$i++)
            {
                $row=$rezultat2->fetch_assoc();
                $pic=$row['img_url'];
                $data=$row['date'];
                echo '<div class="picture">'.$data.'<br/>'.'<img src="'.$pic.'"/>'.'</div><br/><br/>';
            }
            ?>
        </div>
        <div id="user_list">
            <?php user_list()?>
        </div>
    </div>
    <div id="foot">
        Just Img! 2016 &copy; Wszelkie prawa zastrzeżone!
    </div>
</div>

<script src="jquery-3.1.0.min.js" type="text/javascript"></script>
<script>

    $(document).ready(function() {
        var stickyNavTop = $('#menu').offset().top;

        var stickyNav = function(){
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                $('#menu').addClass('sticky');
            } else {
                $('#menu').removeClass('sticky');
            }
        };

        stickyNav();

        $(window).scroll(function() {
            stickyNav();
        });
    });

</script>
</body>

</html>
<?php $polaczenie->close();?>