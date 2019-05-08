<?php
require "../php/database_id.php";
$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
$sql="SELECT Date,Dispositif,Joueurs,Scores FROM Submit WHERE Checked=TRUE";
$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
?>

<html>
    <head>
	<title>Match History</title>
    </head>
    <body>
	<a href="../index.html">Back to index</a>
	<h1>Match History</h1>
	
	<?php while($data=mysqli_fetch_assoc($req)): ?>
            <ins>Date:</ins> <?php echo $data["Date"]; ?> <br/>
            <ins>Dispositif:</ins> <?php echo $data["Dispositif"]; ?> <br/>
            <ins>Joueurs | Scores:</ins> <br/>
            <?php $array=array_combine(explode(',',$data["Joueurs"]),explode(',',$data["Scores"])); ?>
            <?php foreach($array as $joueur => $score): ?>
		<a href="player_page.php?mat=<?php echo $joueur; ?>">
		    fjc-00 <?php echo $joueur; ?>
		</a> : <?php echo $score ?> <br/>
            <?php endforeach; ?>
	    <br/>
	<?php endwhile; ?>
	<?php mysqli_close($con); ?>

    </body>
</html>
