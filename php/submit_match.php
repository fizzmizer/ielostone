<?php

require "database_id.php";

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);

extract($_POST);

$matricules=array();
$scores=array();
for($i=1;$i<=$number_player;$i++){
    $matricules[]=${"mat".$i};
    $scores[]=${"score".$i};
}

$joueurs_str = implode(";",$matricules);
$scores_str = implode(";",$scores);

// DEBUG
// echo strtotime($date);
// echo "<br/>";
// echo $dispositif;
// echo "<br/>";
// echo $joueurs_str;
// echo "<br/>";
// echo $scores_str;
// echo "<br/>";
// DEBUG


$sql = "INSERT INTO Submit (Date,Joueurs,Scores,Dispositif) VALUES ('$date','$joueurs_str','$scores_str','$dispositif')";
$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

mysqli_close($con);
header('Location:../index.html');

?>
