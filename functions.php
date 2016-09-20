<head>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<?php
function main_page()
{
    include "connect.php";
    $polaczenie= new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    $sql="SELECT * FROM pics ORDER BY date DESC";
    $rezultat=@$polaczenie->query($sql);
    for($i=0;$i<$rezultat->num_rows;$i++)
    {
        if($i==10)
            break;
        $rows=$rezultat->fetch_assoc();
        $sql2="SELECT imie_nazwisko FROM uzytkownicy WHERE id_u=".$rows['id_u'];
        $rezultat2=$polaczenie->query($sql2);
        $kto=$rezultat2->fetch_assoc();
        $pic=$rows['img_url'];
        $data=$rows['date'];
        echo $kto['imie_nazwisko'].", dnia ".$data.'<br/>';
        echo '<img src="'.$pic.'" width="400px"/><br/><br/>';
    }
    $polaczenie->close();
}

function user_list()
{
    include "connect.php";
    $polaczenie= new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    $sql="SELECT * FROM uzytkownicy";
    $rezultat=$polaczenie->query($sql);
    $ilosc=$rezultat->num_rows;
    for($i=0;$i<$ilosc;$i++)
    {
        $row=$rezultat->fetch_assoc();
        $userzy[$i]=$row['imie_nazwisko'];
        $id_usera[$i]=$row['id_u'];
        if($i==20)
            break;
    }
    for($i=0;$i<$ilosc;$i++)
    {
        echo '<a href="view_profile.php?id_odw='.$id_usera[$i].'">'.$userzy[$i].'</a><br/>';
    }
    $polaczenie->close();
}
?>