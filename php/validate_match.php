<?php

require "database_id.php";

extract($_POST);

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);

// Construct Three simple Arrays

// --- Elo array (fetch in database)

$sql="SELECT ELO FROM Joueurs 
                 WHERE Banned=FALSE 
                 AND Matricule 
                 IN (".$joueurs.")
                 ORDER BY FIELD(Matricule,".$joueurs.")";

$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

$eloArr=array(); 
while($data=mysqli_fetch_assoc($req)){
    $eloArr[]=$data["ELO"];
}

// --- Score array
$scoresArr = explode(",",$scores);
// --- matricule array
$joueursArr = explode(",",$joueurs);

// Construct the big multi-dim Array from the three small simple array
$bigArray=array();
for($i=0;$i<count($scoresArr);$i++){
    $bigArray[]=array('Score' => $scoresArr[$i], 'Old_ELO' => $eloArr[$i], 'Matricule' => $joueursArr[$i]);
}

// Sorting the Array by Score Desc and if TIE: sorting by elo Asc
array_multisort(
    array_column($bigArray, 'Score'), SORT_DESC,
    array_column($bigArray, 'Old_ELO'), SORT_ASC,
    $bigArray);

function gagnant($eloWin,$eloLoos){
    $pWwin = 1/(1+10**(($eloLoos - $eloWin)/400));
    return round($eloWin + 32*(1-$pWwin));
}

function perdant($eloWin,$eloLoos){
    $pWloo = 1/(1+10**(($eloWin - $eloLoos)/400));
    return round($eloLoos + 32*(0-$pWloo));
}

function get_max_elo($array){
    $index=0;
    $best_elo=0;
    for($i=0;$i<count($array);$i++){
        if($array[$i]['Old_ELO']>$best_elo){
            $index=$i;
            $best_elo=$array[$i]['Old_ELO'];
        }
    }
    return $index;
}

function get_min_elo($array){
    $worst_elo=9*10**10;
    $index=0;
    for($i=0;$i<count($array);$i++){
        if($array[$i]['Old_ELO']<$worst_elo){
            $index=$i;
            $worst_elo=$array[$i]['Old_ELO'];
        }
    }
    return $index;
}

//calcutate new elo
$new_elo=array();
for($i=0;$i<count($bigArray);$i++){
    if($i==0){
        $max_elo_index=get_max_elo(array_slice($bigArray,1))+1;
        $new_elo[]=gagnant($bigArray[0]['Old_ELO'],$bigArray[$max_elo_index]['Old_ELO']);
    } else {
        $min_elo_index=get_max_elo(array_slice($bigArray,0,$i-1));
        $new_elo[]=perdant($bigArray[$max_elo_index]['Old_ELO'],$bigArray[$i]['Old_ELO']);        
    }
}

//insert the new elo into the bigArray
for($i=0;$i<count($bigArray);$i++){
    $bigArray[$i]['New_ELO']=$new_elo[$i];
}

// // DEBUG
// foreach($bigArray as $entry){
//     echo $entry['Score']," ",$entry['Old_ELO']," ",$entry['Matricule']," ",$entry['New_ELO'],"</br>";
// }

$sql="UPDATE Submit SET Checked = TRUE WHERE ID=$id; ";

foreach($bigArray as $entry){
    $sql.="INSERT INTO History (Matricule,SubmitID,ELOHistory) VALUES (".$entry['Matricule'].",".$id.",".$entry['New_ELO']."); ";
    $sql.="UPDATE Joueurs SET ELO=".$entry['New_ELO']." WHERE Matricule=".$entry['Matricule']."; ";
}


mysqli_multi_query($con,$sql) or die('Error SQL <br/>'.$sql.'<br/>'.mysqli_error($con));
mysqli_close($con);
header("Location:../pages/check_submit_page.php");

?>
