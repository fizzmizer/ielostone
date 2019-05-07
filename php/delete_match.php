<?php

require "database_id.php";

extract($_POST);

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
$sql="DELETE FROM Submit WHERE ID=$id";

$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

mysqli_close($con);
header("Location:../pages/check_submit_page.php");

?>
