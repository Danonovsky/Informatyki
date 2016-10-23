<?php
session_start();
require_once "connect.php";
if(!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany']==false)
{
    header('Location: index.php');
    exit();
}
if(!isset($_GET['id_pic']) || $_GET['id_pic']==NULL)
{
    header('Location: portal.php');
    exit();
}
$polaczenie= new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
$id=$_GET['id_pic'];
$id_u=$_SESSION['id'];
$sql="SELECT img_url,id_pic FROM pics WHERE id_pic='$id' AND id_u='$id_u'";
if($rezultat=$polaczenie->query($sql))
{
    if($rezultat->num_rows>0)
    {
        $wiersz=$rezultat->fetch_assoc();
        $url=$wiersz['id_pic'];
        $sql1="DELETE FROM pics WHERE id_pic='$id'";
        if($polaczenie->query($sql1))
        {
            unlink($url);
            $_SESSION['alert']="Zdjęcie usunięte!";
        }
    }
}
$polaczenie->close();
header('Location:my_pics.php');