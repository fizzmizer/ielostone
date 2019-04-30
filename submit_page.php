<html>
  <head>
    <title>Submit Match</title>
  </head>
  <body>
    <h1>Submit Match</h1>
    
    <?php
      echo '<form method="post" action="php/submit_match.php" enctype="multipart/form-data" style="border-style:solid; border-color:white; padding:10px;">';
      echo '<p>';
      echo '<ins>Date:</ins> <input type="date" name="date"/> <br/><br/>';
      
      // TODO : Gérer les nouveaux joueurs
      
      $joueurs=array("Ludovic"=>"fjc-001","Antoine"=>"fjc-002","Samuel"=>"fjc-003");
      // TODO Get the array from the database :
      // require "php/database_id.php";
      // mysql_connect(DB_host,DB_login,DB_password);
      // mysql_select_db(DB_database);
      
      // $sql="SELECT Nom_joueur, Matricule_joueur FROM joueurs_elo";
      // $req=mysql_query($sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysql_error());
      
      // while($data=mysql_fetch_assoc($req)){
      //     $joueurs[$data["Nom_joueur"]]=$data["Matricule_joueur"];
      // }
      
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
