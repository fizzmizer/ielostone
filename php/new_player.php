<?php

require "database_id.php";

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);

extract($_POST);

$sql="INSERT INTO Joueurs (Nom,Prenom) VALUES ('".$nom."','".$prenom."');";

mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

header("Location:../index.html");

?>
