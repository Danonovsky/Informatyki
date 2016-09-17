<?php
function main_page()
{
    require_once "connect.php";
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
        $rows=mysqli_fetch_assoc($rezultat);
        $pic=$rows['img_url'];
        echo '<img src="'.$pic.'" width="20%"/><br/>';
    }
    $polaczenie->close();
}
?>