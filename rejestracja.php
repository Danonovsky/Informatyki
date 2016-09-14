<?php
session_start();



if (isset($_POST['email']))
{
    //udana walidacja?
    $wszystko_OK=true;

    //Sprawdź nickname
    $nick = $_POST['nick'];

    $imie_nazwisko = $_POST['imie_nazwisko'];
    $data_urodzenia = $_POST['data_urodzenia'];
    $zamieszkanie = $_POST['zamieszkanie'];

  

    //sprawdzenei długości nicka
    if ((strlen($nick)<3) || (strlen($nick)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
    }


    if (ctype_alnum($nick)==false)
    {
        $wszystko_OK=false;
        $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(Bez polskich znaków)";
    }

    //Sprawdź poprawność adresu email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $wszystko_OK=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }

    //Sprawdź poprawność hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    if ((strlen($haslo1)<8) || (strlen($haslo2)>20))
    {
        $_SESSION['e_haslo']="hasło musi posiadać od 8 do 20 znaków";
    }

    if ($haslo1!=$haslo2)
    {
        $_SESSION['e_haslo']="Podane hasła nie są takie same!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    //Czy zaakceptowano regulamin
    if (!isset($_POST['regulamin']))
    {
        $_SESSION['e_regulamin']="Nie zaakceptowano regulaminu!";
    }

    //Bot or not? Zelent śmieszek xD
    $sekret = "6Le32CkTAAAAAO93gcJGSg3HkvKm-2xf6gL0sEiH";

    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

    $odpowiedz = json_decode($sprawdz);

    if ($odpowiedz->success==false)
    {
        $_SESSION['e_bot']="Potwierdz, że nie jesteś botem!";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            //Czy jest mail?
            $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
            if (!$rezultat)throw new Exception($polaczenie->error);
            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail";
            }

            //Czy nick jest zajęty??
            $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE login='$nick'");
            if (!$rezultat)throw new Exception($polaczenie->error);
            $ile_takich_nickow = $rezultat->num_rows;
            if ($ile_takich_nickow>0)
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Istnieje już gracz o takim nicku!";
            }

            if ($wszystko_OK==true)
            {
                //Wszystko zaliczone dodajemy do bazy
                if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$imie_nazwisko', '$data_urodzenia', '$zamieszkanie', '$email', '$nick', '$haslo_hash')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: witamy.php');
                }
                else
                {
                    throw new Exception($polaczenie->error);
                }
            }

            $polaczenie->close();
        }
    }
    catch(Exception $e)
    {
        echo '</br>Informacja deweloperska'.$e;
        echo "Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie.";
    }


}




?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1"/>
    <title>Just Img! - Załóż darmowe konto!</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>

<form method="post">
    Nickname:</br> <input type="text" name="nick"/></br>
    <?php
    if (isset($_SESSION['e_nick']))
    {
        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
        unset($_SESSION['e_nick']);
    }
    ?>
    E-mail:</br> <input type="text" name="email"/></br>
    <?php
    if (isset($_SESSION['e_email']))
    {
        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }
    ?>
    Hasło:</br> <input type="password" name="haslo1"/></br>
    <?php
    if (isset($_SESSION['e_haslo']))
    {
        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
        unset($_SESSION['e_haslo']);
    }
    ?>
    Powtórz hasło:</br> <input type="password" name="haslo2"/></br>
    Imię oraz nazwisko(np. Jan Kowalski):</br> <input type="text" name="imie_nazwisko"/></br>
    Data urodzenia(Rok-miesiąc-dzień):<br><input type="text" name="data_urodzenia"><br>
    Miejsce zamieszkania:<br><input type="text" name="zamieszkanie"><br>
    <label><input type="checkbox" name="regulamin"/>Akceptuję regulamin</label>
    <?php
    if (isset($_SESSION['e_regulamin']))
    {
        echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
        unset($_SESSION['e_regulamin']);
    }
    ?>
    <div class="g-recaptcha" data-sitekey="6Le32CkTAAAAAPtuFlU7B7l-vXrXYXwXINzboP-F"></div>
    <?php
    if (isset($_SESSION['e_bot']))
    {
        echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
        unset($_SESSION['e_bot']);
    }
    ?>
    </br>
    <input type="submit" value="Zarejestruj się"/>
</form>


</body>
</html>