<?php

require "database_id.php";

extract($_POST);

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);

$sql="UPDATE Submit SET Checked = TRUE WHERE ID=$id";
$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

          // echo "<input type=\"hidden\" name=\"date\" value=\"$data["Date"]\">";
          // echo "<input type=\"hidden\" name=\"dispositif\" value=\"$data["Dispositif"]\">";
          // echo "<input type=\"hidden\" name=\"joueurs\" value=\"$data["Joueurs"]\">";
          // echo "<input type=\"hidden\" name=\"scores\" value=\"$data["Scores"]\">";

// TODO NEED TO INSERT INTO THE HISTORY TABLE
// $sql2="INSERT INTO History ... ";
// $req2 = mysqli_query($con,$sql2) or die('Error SQL <br/>' .$sql2.'<br/>'.mysqli_error($con));

// TODO NEED TO CALCULATE THE NEW ELO AND UPDATE THE NEW ELO FOR EACH PLAYER
// foreach($joueurs as $joueur){
//     $new_elo=calculate($elo)
// }

// $sql3="UPDATE Submit SET Checked = TRUE WHERE ID=$id";
// $req3 = mysqli_query($con,$sql3) or die('Error SQL <br/>' .$sql3.'<br/>'.mysqli_error($con));

mysqli_close($con);
header("Location:../check_submit_page.php");


?>
