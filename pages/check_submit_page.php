<html>
    <head>
	<title>Check Submitted match</title>
    </head>
    <body>
	<a href="../index.html">Back to index</a>
	<h1>Check Submitted match</h1>
	<?php
	require "../php/database_id.php";
	$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
	$sql = "SELECT Prenom,Nom,Matricule FROM Joueurs WHERE Approved = FALSE ";
	$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
	$num=1;
	?>
	<h1>Player check</h1>

	<?php while($data=mysqli_fetch_assoc($req)): ?>
	    <ins>Joueur <?php echo $num++; ?></ins> :<?php echo $data['Prenom']; ?> <?php echo $data['Nom']; ?>
	    <a href="../php/add_player.php?mat=<?php echo $data['Matricule']; ?>">Approuver</a>
	    <a href="../php/del_player.php?mat=<?php echo $data['Matricule']; ?>">Supprimer</a>
	    <br/>
	<?php endwhile; ?>

	<?php 
        $sql = "SELECT ID,Date,Joueurs,Scores,Dispositif FROM Submit WHERE Checked = FALSE ";
	$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
	$num=1;
	?>
	<h1>Match check</h1>
	<?php while($data=mysqli_fetch_assoc($req)): ?>
	    
            <?php
	    $joueurs=explode(",",$data["Joueurs"]);
            $scores=explode(",",$data["Scores"]);
	    ?>
	    
	    <div id="submission">
		
		<h2>Submission <?php echo $num++; ?> :</h2>

		<ins>Date :</ins> <?php echo $data["Date"]; ?> <br/>
		<ins>Dispositif :</ins> <?php echo $data["Dispositif"]; ?> <br/>
		<ins>Joueur | Score :</ins> <br/>
		<?php for($i=0;$i<count($joueurs);$i++): ?>
		    fjc-00 <?php echo $joueurs[$i]; ?> : <?php echo $scores[$i]; ?> <br/>
		<?php endfor; ?>
		<br/>

		<form method="post" action="../php/validate_match.php" enctype="multipart/form-data">
		    <input type="hidden" name="joueurs" value="<?php echo $data["Joueurs"]; ?>">
		    <input type="hidden" name="id" value="<?php echo $data["ID"]; ?>">
		    <input type="hidden" name="scores" value="<?php echo $data["Scores"]; ?>">
		    <input type="submit" value="Valide"/>
		</form>

		<form method="post" action="../php/delete_match.php" enctype="multipart/form-data">
		    <input type="hidden" name="id" value="<?php echo $data["ID"]; ?>">
		    <input type="submit" value="Non Valide (DELETE)"/>
		</form>

            </div>
	<?php endwhile; ?>
	<?php mysqli_close($con); ?>

    </body>
</html>
