<html>
  <head>
    <title>Inscription</title>
  </head>
  <body>
    <a href="../index.html">Back to index</a>
    <h1>Inscription</h1>
    
    <?php
         echo '<form method="post" action="../php/new_player.php" enctype="multipart/form-data">';
      echo '<p>';
      echo "Nom : <input type=\"text\" name=\"nom\" autocomplete=\"off\" /> <br/>";
      echo "Prénom : <input type=\"text\" name=\"prenom\" autocomplete=\"off\" /> <br/>";
      echo '</p>';
      echo '<input type="submit" value="Send"/>';
      echo '</form>';
    ?>
    
    
  </body>
</html>
