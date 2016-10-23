<?php
session_start();
require_once "functions.php";
if(!isset($_SESSION['zalogowany']))
{
    header('Location:index.php');
    exit();
}

if(isset($_FILES['plik']['name']))
{
    $p_pojemnosc=$_FILES['plik']['size'];
    $p_typ=$_FILES['plik']['type'];
    $p_nazwa=$_FILES['plik']['name'];
    $p_smiec=$_FILES['plik']['tmp_name'];

    $p_roz=array_pop(explode(".",$p_nazwa));
    $max_size=round(($_POST['max_file_size']/1048576),3).'MB';

    $poj_MB=round(($p_pojemnosc/1048576),2).'MB';

    $p_nazwa_zm=(md5($p_nazwa)).".".$p_roz;
    $folder="pliki/";

    //olewamy kolorki Misioka i kodzimy dalej

    if($p_pojemnosc<=0)
    {
        echo('Plik jest pusty, nie mogę go przesłać<br/>');
        echo('<a href="add_photo.php">Powrót</a>');
    }
    else if($poj_MB>$max_size)
    {
        echo 'Plik jest za duży, maksymalny rozmiar:'.$max_size.'<br/>';
        echo '<a href="add_photo.php">Powrót</a>';
    }
    else if(file_exists($folder.$p_nazwa_zm))
    {
        echo 'Plik o takiej nazwie już istnieje <br/>';
        echo '<a href="add_photo.php">Powrót</a>';
    }
    else
    {
        if(!@move_uploaded_file($p_smiec,$folder.$p_nazwa_zm))
        {
            echo 'Nie można zapisać pliku! Coś się, coś się zepsuło, więc spróbuj jeszcze raz';
            exit();
        }
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        $polaczenie= new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
        if($polaczenie->connect_errno!=0)
        {
            echo "Error: ".$polaczenie->connect_errno;
        }
        else
        {
            echo 'Przesłanie udało się!<br/>';
            echo $max_size.'<br/>';
        }
        $path_file=$folder.$p_nazwa_zm;
        //ważne date('Y m d');
        $data=date('Y-m-d H-i-s');
        $id_usera=$_SESSION['id'];
        if($polaczenie->query("insert into pics (id_pic,id_u,img_url,date) values(NULL,'$id_usera','$path_file','$data')") === TRUE)
        {
            echo "udało się";
        }
        else
        {
            echo "Error: ".$polaczenie->error;
        }
    }
    $polaczenie->close();
}

?>
<!DOCTYPE HTML>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Just Image! - dodaj zdjęcie</title>
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
            <form method="post" name="form1" enctype="multipart/form-data">
                <h1>Dodawanie zdjęcia!</h1>
                <input type="file" accept="image/*" name="plik" size="50"/>
                <input name="max_file_size" type="hidden" value="1048576" /><br/><br/>
                <input type="submit" value="Wyślij plik!"/>
            </form>
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
