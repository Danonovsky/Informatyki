<?php
session_start();
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
        }
        $path_file=$folder.$p_nazwa_zm;
        //ważne date('Y m d');
        $data=date('Y-m-d');
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
    <title>Just Image! - dodaj zdjęcie</title>
</head>
<body>
<form method="post" name="form1" enctype="multipart/form-data">
    <div align="center">
        <h1>Dodawanie zdjęcia!</h1>
        <input type="file" accept="image/*" name="plik" size="50"/>
        <input name="max_file_size" type="hidden" value="1048576" /><br/><br/>
        <input type="submit" value="Wyślij plik!"/>
        <a href="portal.php"><input type="button" value="Powrót"/></a>
    </div>
</form>
</body>
</html>
