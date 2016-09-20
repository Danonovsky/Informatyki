<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
require_once "connect.php";
require_once "functions.php";
$polaczenie= @new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
if($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
$sql='SELECT * FROM pics WHERE id_u='.$_SESSION['id'];
$rezultat=$polaczenie->query($sql);
$ilosc=$rezultat->num_rows;
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
<div id="box">
    <div id="menu">
        <ol>
            <li><?php echo $_SESSION['imie_nazwisko'];?></li>
            <li><a href="portal.php">Strona główna</a></li>
            <li><a href="my_pics.php">Moje zdjęcia</a></li>
            <li><a href="add_photo.php">Dodaj zdjęcie</a></li>
            <li><a href="#">O autorach</a></li>
            <li><a href="logout.php">Wyloguj się</a></li>
        </ol>
    </div>
    <div id="box2">
        <div id="content">
            <?php
            for($i=0;$i<$ilosc;$i++)
            {
                $rows=$rezultat->fetch_assoc();
                $pic=$rows['img_url'];
                $data=$rows['date'];
                echo '<div class="picture">'.$data.'<br/>'.'<img src="'.$pic.'" width="400px"/><br/>'.'</div>'.'<br/><br/>';
            }
            $polaczenie->close();
            ?>
        </div>
        <div id="user_list">
            <?php user_list()?>
        </div>
    </div>
    <div id="foot">
        Bla;
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
