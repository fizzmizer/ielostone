<html>
  <head>
    <title>Submit Match</title>
  </head>
  <body>
    <h1>Submit Match</h1>
    
    <form method="post" action="php/submit_match.php" enctype="multipart/form-data" style="border-style:solid; border-color:white; padding:10px;">
      <p>
	<ins>Date:</ins> <input type="date" name="_date"/> </br></br>
	<?php
      // TODO : Gérer les nouveaux joueurs
      $joueurs=array("Ludovic"=>"001","Antoine"=>"002","Samuel"=>"003");
          
          //TODO Get the array from the database
      // require "database_id.php";
      // mysql_connect(DB_host,DB_login,DB_password);
      // mysql_select_db(DB_database);
                                            
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
			   ?>
      </p>
      <input type="submit" value="Send"/>
    </form>
    
    
  </body>
</html>
