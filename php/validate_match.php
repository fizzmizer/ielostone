<?php

require "database_id.php";

extract($_POST);

$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);

// $sql="UPDATE Submit SET Checked = TRUE WHERE ID=$id";
// $req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));


// TODO : mettre directement le "," à la place de ";"
$scoresArr = explode(";",$scores);
$joueursArr = explode(";",$joueurs);

$joueursStr = implode(",",$joueursArr);

$sql="SELECT ELO FROM Joueurs 
                 WHERE Banned=FALSE 
                 AND Matricule 
                 IN (".$joueursStr.")
                 ORDER BY FIELD(Matricule,".$joueursStr.")";

$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

$eloArr=array();

while($data=mysqli_fetch_assoc($req)){
    $eloArr[]=$data["ELO"];
}

$bigArray=array();

for($i=0;$i<count($scoresArr);$i++){
    $bigArray[]=array('Score' => $scoresArr[$i], 'ELO' => $eloArr[$i], 'Matricule' => $joueursArr[$i]);
}

array_multisort(
    array_column($bigArray, 'Score'), SORT_DESC,
    array_column($bigArray, 'ELO'), SORT_ASC,
    $bigArray);

function gagnant($eloWin,$eloLoos){
    $pWwin = 1/(1+10**($eloLoos - $eloWin)/400);

    return round($eloWin + 32*(1-$pWwin));
}

function perdant($eloWin,$eloLoos){
    $pWloo = 1/(1+10**($eloWin - $eloLoos)/400);

    return round($eloLoos + 32*(0-$pWloo));
}

function get_max_elo($array){
    $index=0;
    $best_elo=0;
    for($i=0;$i<count($array);$i++){
        if($array[$i]['ELO']>$best_elo){
            $index=$i;
            $best_elo=$array[$i]['ELO'];
        }
    }
    return $index;
}

function get_min_elo($array){
    $worst_elo=9*10**10;
    $index=0;
    for($i=0;$i<count($array);$i++){
        if($array[$i]['ELO']<$worst_elo){
            $index=$i;
            $worst_elo=$array[$i]['ELO'];
        }
    }
    return $index;
}

//calcutate new elo
$new_elo=array();
for($i=0;$i<count($bigArray);$i++){
    if($i==0){
        $max_elo_index=get_max_elo(array_slice($bigArray,1));
        $new_elo[]=gagnant($bigArray[$i]['ELO'],$bigArray[$max_elo_index]['ELO']);        
    } else {
        $min_elo_index=get_max_elo(array_slice($bigArray,0,$i-1));
        $new_elo[]=perdant($bigArray[$max_elo_index]['ELO'],$bigArray[$i]['ELO']);        
    }
}

//replace the new elo
for($i=0;$i<count($bigArray);$i++){
    echo $i,"<br/>";
    echo $bigArray[$i]['ELO'],"<br/>";
    echo $bigArray[$i]['Matricule'],"<br/>";
    echo $new_elo[$i],"<br/>";
    echo "<br/>";
    $bigArray[$i]['ELO']=$new_elo[$i];
}

// DEBUG
foreach($bigArray as $entry){
    echo $entry['Score']," ",$entry['ELO']," ",$entry['Matricule'],"</br>";
}


// Update the elo 

    // foreach($joueurs_array as $joueur){
    //     //INSERT INTO History
    //     //UPDATE Joueurs with new ELO
    // }

// TODO NEED TO INSERT INTO THE HISTORY TABLE
// $sql2="INSERT INTO History (Matricule,SubmitID,ELOHistory) VALUES ($matricule) ";
// $req2 = mysqli_query($con,$sql2) or die('Error SQL <br/>' .$sql2.'<br/>'.mysqli_error($con));

// TODO NEED TO CALCULATE THE NEW ELO AND UPDATE THE NEW ELO FOR EACH PLAYER
// foreach($joueurs as $joueur){
//     $new_elo=calculate($elo)
// }

// $sql3="UPDATE Submit SET Checked = TRUE WHERE ID=$id";
// $req3 = mysqli_query($con,$sql3) or die('Error SQL <br/>' .$sql3.'<br/>'.mysqli_error($con));

// mysqli_close($con);
// header("Location:../check_submit_page.php");

?>
