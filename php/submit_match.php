<html>
  <head>
    <title>Submit Match</title>
  </head>
  <body>
    <h1>Submit Match</h1>
    <?php
      
      // require "database_id.php";
      // mysql_connect(DB_host,DB_login,DB_password);
      // mysql_select_db(DB_database);
      
      extract($_POST);
      
      $matricules=array();
      $scores=array();
      
      for($i=1;$i<=$number_player;$i++){
          $matricules[]=${"mat".$i};
          $scores[]=${"score".$i};
      }
      
      for($i=0;$i<$number_player;$i++){
          echo $matricules[$i];
          echo $scores[$i];
          
      }
      
    ?>
</body></html>
