<html>
  <head>
    <title>Submit Match</title>
  </head>
  <body>
    <a href="index.html">Back to index</a>
    <h1>Submit Match</h1>
    
    <?php
      echo '<form method="post" action="php/submit_match.php" enctype="multipart/form-data">';
      echo '<p>';
      echo '<ins>Date :</ins> <input type="date" name="date"/> <br/><br/>';
      // QUESTION On garde l'option dispositif ?
      echo '<ins>Dispositif (optionnel) :</ins>';
      echo '<select name="dispositif">';
      echo '<option value=""></option>';
      echo '<option value="Brandelet">Brandelet</option>';
      echo '<option value="Ducobu">Ducobu</option>';
      echo '<option value="Fairplay">Fairplay</option>';
      echo '</select></br>';

      
      // TODO : Gérer les nouveaux joueurs

      // FOR DEBUG (without database)
      // $joueurs=array("Ludovic"=>"fjc-001","Antoine"=>"fjc-002","Samuel"=>"fjc-003");

      // Get the array from the database :
      require "php/database_id.php";
      $con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
      $sql = "SELECT Nom, Prenom, Matricule FROM Joueurs";
      $req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
      
      while($data=mysqli_fetch_assoc($req)){
          $joueurs[$data["Nom"]." ".$data["Prenom"]]=$data["Matricule"];
      }
      
      $nj=$_GET["nj"];
      
      if(!$nj){
          $nj=2;             
      }
      
      for($i=1;$i<=$nj;$i++){    
          echo "<ins>Joueur $i :</ins><br/>";
          echo "Nom :";
          echo "<select name=\"mat$i\">";
          echo "<option value=\"\"></option>";
          foreach($joueurs as $name => $mat){
              echo "<option value=\"$mat\">$name</option>";
          }
          echo "</select></br>";
          echo "Score : <input type=\"number\" name=\"score$i\" autocomplete=\"off\" /> <br/>";
          echo "</br>";
      }
      $njadd=$nj+1;
      $njrem=$nj-1;
      echo "<a href=\"submit_page.php?nj=$njadd\" >Add player</a></br>";
      if($nj>2){
          echo "<a href=\"submit_page.php?nj=$njrem\" >Remove Player</a>";
      }
      echo "<input type=\"hidden\" name=\"number_player\" value=\"$nj\">";
      echo '</p>';
      echo '<input type="submit" value="Send"/>';
      echo '</form>';
    ?>


</body>
</html>
