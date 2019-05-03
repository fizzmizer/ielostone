<html>
  <head>
    <title>Check Submitted match</title>
  </head>
  <body>
    <a href="index.html">Back to index</a>
    <h1>Check Submitted match</h1>
    
    <?php
      
      require "php/database_id.php";

      $con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
      $sql = "SELECT * FROM Submit WHERE Checked = 0 ";

      $req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));
      $num=1;
      while($data=mysqli_fetch_assoc($req)){
          $joueurs=explode(";",$data["Joueurs"]);
          $scores=explode(";",$data["Scores"]);
          echo '<div id="submission">';
          echo '<h2>Submission '.$num.' :</h2>';
          echo '<ins>Date :</ins> ';
          echo $data["Date"];
          echo '<br/>';
          echo '<ins>Dispositif :</ins> ';
          echo $data["Dispositif"];
          echo '<br/>';
          echo '<ins>Joueur / Score :</ins> <br/>';
          for($i=0;$i<count($joueurs);$i++){
              echo "fjc-00".$joueurs[$i]," : ",$scores[$i],"<br/>";
          }
          echo '<br/>';
          echo '<form method="post" action="php/validate_match.php" enctype="multipart/form-data">';
          echo '<input type="hidden" name="date" value="'.$data["Date"].'">';
          echo '<input type="hidden" name="dispositif" value="'.$data["Dispositif"].'">';
          echo '<input type="hidden" name="joueurs" value="'.$data["Joueurs"].'">';
          echo '<input type="hidden" name="scores" value="'.$data["Scores"].'">';
          echo '<input type="submit" value="Valide"/>';
          echo '</form>';
          echo '<form method="post" action="php/delete_match.php" enctype="multipart/form-data">';
          echo '<input type="hidden" name="id" value="'.$data["ID"].'">';
          echo '<input type="submit" value="Non Valide (DELETE)"/>';
          echo '</form>';
          echo '</div>';
          $num++;
      }
      
    ?>


</body>
</html>
