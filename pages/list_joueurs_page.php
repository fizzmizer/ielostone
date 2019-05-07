<html>
  <head>
    <title>Liste des joueurs</title>
  </head>
  <body>
    <a href="../index.html">Back to index</a>
    <h1>Liste des joueurs</h1>

    <?php

      require "../php/database_id.php";

      $con = mysqli_connect(DB_host,DB_login,DB_password,DB_database);
      $sql="SELECT Nom,Prenom,ELO FROM Joueurs WHERE Banned=FALSE";
      
      $req = mysqli_query($con,$sql) or die('Error SQL <br/>' .$sql.'<br/>'.mysqli_error($con));

      while($data=mysqli_fetch_assoc($req)){
          echo $data["Prenom"]," ",$data["Nom"]," : ",$data["ELO"];
          echo '<br/>';
      }
      mysqli_close($con);

    ?>    

  </body>
</html>
