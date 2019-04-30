<?php

// require "database_id.php";
// mysql_connect(DB_host,DB_login,DB_password);
// mysql_select_db(DB_database);

extract($_POST);

$matricules=array();
$scores=array();
$best_score=0;
$winner="";
for($i=1;$i<=$number_player;$i++){
    $matricules[]=${"mat".$i};
    $scores[]=${"score".$i};
    if(${"score".$i}>$best_score){
        $best_score=${"score".$i};
        $winner=${"mat".$i};
    }
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
// echo $best_score;
// echo "<br/>";
// echo $winner;
// DEBUG

// $sql="INSERT INTO match_submit (date,nombre_joueur,joueurs,scores,winner,validation) VALUES ('".strtotime($date)."','$number_player','$joueurs_str','$scores_str','$winner',FALSE)";
// $req = mysql_query($sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysql_error());

?>
