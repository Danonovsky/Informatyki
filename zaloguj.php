<?php

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_errno ;
}
else {

if (isset($_POST['login'])) {
$login = $_POST['login'];
}
if (isset($_POST['haslo'])) {
$haslo = $_POST['haslo'];
}
$sql = "select * from uzytkownicy where user='$login'; and pass='$haslo'";
if ( $rezultat = $polaczenie->query($sql)){
$ilu_userow = $rezultat->num_rows;
if ($ilu_userow>0){
$wiersz = $rezultat->fetch_assoc();
$user = $wiersz['user'];


$rezultat->free_result();
echo $user;
}else{

}

}

}

$polaczenie->close();
?>