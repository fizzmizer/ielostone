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
?>
<html>
  <head>
   <?php
      echo "<title>",$prenom," ",$nom,"</title>";
    ?>
  </head>
  <body>
    <a href="list_joueurs_page.php">Back to list</a>
    <?php
      echo "<h1>",$prenom," ",$nom,"</h1>";
      $num=1;
      foreach($bigArray as $data){
          echo "<h2>Match ",$num++,"</h2>";
          echo "Date: ",$data["Date"],'<br/>';
          echo "ELO: ",$data["ELOHistory"],'<br/>';
          echo "Dispositif: ",$data["Dispositif"],'<br/>';
          echo "Joueurs | Scores:  <br/>";
          foreach($data["JSarray"] as $joueur => $score){
              
              if ($joueur==$_GET['mat']){
                  echo "<font color=red>","fjc-00",$joueur," : ",$score,"</font>",'<br/>';
              } else {
                  echo "fjc-00",$joueur," : ",$score,'<br/>';
              }

          }
          echo '<br/>';
      }
      

    ?>    

  </body>
</html>
