<?php

require "database_id.php";

$con=mysqli_connect(DB_host,DB_login,DB_password,DB_database);

$sql = "UPDATE Joueurs SET Approved = TRUE WHERE Matricule = ".$_GET["mat"];

$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

header("Location:../pages/check_submit_page.php");

?>
