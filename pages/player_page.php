<?php
require "../php/database_id.php";
$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
$sql=  "SELECT j.Nom,
               j.Prenom,
               h.ELOHistory,
               s.Date,
               s.Joueurs,
               s.Scores,
               s.Dispositif
        FROM Joueurs AS j
        INNER JOIN History AS h 
               ON j.Matricule=h.Matricule
        INNER JOIN Submit AS s 
               ON h.SubmitID=s.ID 
        WHERE s.Checked = TRUE AND j.Matricule=".$_GET['mat']."
        ORDER BY s.Date";
$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
$bigArray=array();
while($data=mysqli_fetch_assoc($req)){
    $prenom=$data["Prenom"];
    $nom=$data["Nom"];
    $bigArray[]=array(
        "Date" => $data["Date"],
        "ELOHistory" => $data["ELOHistory"],
        "JSarray" => array_combine(explode(',',$data["Joueurs"]),explode(',',$data["Scores"])),
        "Dispositif" => $data["Dispositif"]);
}
mysqli_close($con);
$num=1;
?>

<html>

    <head>
	<title> <?php echo $prenom," ",$nom; ?> </title>
    </head>

    <body>

	<a href="list_joueurs_page.php">Back to list</a>

	<h1><?php echo $prenom," ",$nom; ?></h1>

	<?php foreach($bigArray as $data):?>

	    <h2>Match <?php echo $num++; ?></h2>
	    <ins>Date:</ins> <?php echo $data["Date"]; ?><br/>
	    <ins>ELO:</ins> <?php echo $data["ELOHistory"]; ?><br/>
	    <ins>Dispositif:</ins> <?php echo $data["Dispositif"]; ?><br/>
	    Joueurs | Scores:  <br/>

	    <?php foreach($data["JSarray"] as $joueur => $score): ?>

		<?php if ($joueur==$_GET['mat']): ?>
		    <font color=red> fjc-00<?php echo $joueur," : ",$score; ?></font><br/>
		<?php else: ?>
		    fjc-00<?php echo $joueur," : ",$score; ?><br/>
		<?php endif; ?>

	    <?php endforeach; ?>
	    <br/>
	<?php endforeach; ?>

    </body>
</html>
