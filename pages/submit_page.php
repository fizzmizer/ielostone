<?php
require "../php/database_id.php";
$con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
$sql = "SELECT Nom, Prenom, Matricule FROM Joueurs WHERE Banned = FALSE AND Approved = TRUE";
$req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

while($data=mysqli_fetch_assoc($req)){
    $joueurs[$data["Nom"]." ".$data["Prenom"]]=$data["Matricule"];
}

mysqli_close($con);

$nj=(isset($_GET["nj"])) ? $_GET["nj"] : 2;
$njadd=$nj+1;
$njrem=$nj-1;

?>

<html>
    <head>
	<title>Submit Match</title>
    </head>
    <body>
	<a href="../index.html">Back to index</a>
	<h1>Submit Match</h1>
	
	<form method="post" action="../php/submit_match.php" enctype="multipart/form-data">
	    <ins>Date :</ins> <input type="date" name="date"/> <br/><br/>
	    <ins>Dispositif (optionnel) :</ins>
	    <select name="dispositif">
		<option value=""></option>
		<option value="Brandelet">Brandelet</option>
		<option value="Ducobu">Ducobu</option>
		<option value="Fairplay">Fairplay</option>
	    </select></br>

	    <?php for($i=1;$i<=$nj;$i++): ?>
		<ins>Joueur <?php echo $i; ?> :</ins><br/>
		Nom :
		<select name="mat<?php echo $i; ?>">
		    <option value=""></option>
		    <?php foreach($joueurs as $name => $mat): ?>
			<option value="<?php echo $mat; ?>"><?php echo $name; ?></option>
		    <?php endforeach; ?>
		</select> </br>
		Score : <input type="number" name="score<?php echo $i; ?>" autocomplete="off" />
		<br/>
		<br/>
	    <?php endfor; ?>
	    <a href="submit_page.php?nj=<?php echo $njadd; ?>" >Add player</a></br>
	    <?php if($nj>2): ?>
		<a href="submit_page.php?nj=<?php echo $njrem; ?>" >Remove Player</a>
	    <?php endif; ?>
	    <input type="hidden" name="number_player" value="<?php echo $nj; ?>">
	    <input type="submit" value="Send"/>
	</form>
	
    </body>
</html>
