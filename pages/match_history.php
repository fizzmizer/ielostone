<html>
  <head>
    <title>Match History</title>
  </head>
  <body>
    <a href="../index.html">Back to index</a>
    <h1>Match History</h1>

    <?php

      require "../php/database_id.php";

      $con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
      $sql="SELECT Date,Dispositif,Joueurs,Scores FROM Submit WHERE Checked=TRUE";

      $req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

      while($data=mysqli_fetch_assoc($req)){
          echo "Date: ",$data["Date"],'<br/>';
          echo "Dispositif: ",$data["Dispositif"],'<br/>';
          echo "Joueurs | Scores:  <br/>";
          $array=array_combine(explode(',',$data["Joueurs"]),explode(',',$data["Scores"]));
          foreach($array as $joueur => $score){
              echo '<a href="player_page.php?mat='.$joueur.'">',"fjc-00",$joueur,'</a>'," : ",$score,'<br/>';
          }
          echo "<br/>";
      }
      mysqli_close($con);

    ?>    

  </body>
</html>
