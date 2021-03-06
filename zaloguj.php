<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: index.php');
    exit();
}

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
    $login = htmlentities($login, ENT_QUOTES,"UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES,"UTF-8");

    if ($rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
            mysqli_real_escape_string($polaczenie,$login))))
    {
        $ilu_userow = $rezultat->num_rows;
        if($ilu_userow>0)
        {
            $wiersz = $rezultat->fetch_assoc();

            if (password_verify($haslo, $wiersz['haslo']))
            {
                $_SESSION['zalogowany'] = true;
                $_SESSION['id'] = $wiersz['id_u'];
                $_SESSION['user'] = $wiersz['login'];
                $_SESSION['imie_nazwisko'] = $wiersz['imie_nazwisko'];
                $_SESSION['data_ur'] = $wiersz['data_ur'];
                $_SESSION['email'] = $wiersz['email'];
                $_SESSION['miejscowosc'] = $wiersz['miejscowosc'];

                unset($_SESSION['blad']);
                $rezultat->free_result();
                header('Location: portal.php');
            }
            else
            {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło</span>';
                header('Location: index.php');
            }
        } else{

            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło</span>';
            header('Location: index.php');

        }

    }

}
$polaczenie->close();
?>