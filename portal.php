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
            <?php main_page();?>
        </div>
        <div id="user_list">
            <?php user_list(); ?>
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