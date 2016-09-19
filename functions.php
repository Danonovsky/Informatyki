<?php
function main_page()
{
    require_once "connect.php";
    $polaczenie= @new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
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
        $rezultat2=@$polaczenie->query($sql2);
        $kto=$rezultat2->fetch_assoc();
        $pic=$rows['img_url'];
        $data=$rows['date'];
        echo $kto['imie_nazwisko'].", dnia ".$data.'<br/>';
        echo '<img src="'.$pic.'" width="20%"/><br/><br/>';
    }
    $polaczenie->close();
}

function user_list()
{
    require_once "connect.php";
    $polaczenie= @new mysqli($host,$db_user,$db_password,$db_name) or die('Error connecting to mysql');
    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    $query="SELECT * FROM uzytkownicy";
    $result=@$polaczenie->query($query);
    $ilosc=$result->num_rows;
    for($i=0;$i<$ilosc;$i++)
    {
        $row=$result->fetch_assoc();
        echo $row['imie_nazwisko'].'<br/>';
        if($i==20)
            break;
    }
    $polaczenie->close();
}
?>