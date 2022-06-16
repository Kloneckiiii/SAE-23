<?php
//---------------------connexion a la base de donnee---------------------
$servername = "localhost";
$username = "eliott";
$password = "bonjour";
$dbname = "bd_sae23";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

?>
<html>
<body>
  <section>
    <p>Vous pouvez consulter la dernière mesure de chacune des salles</p>
    <?php
    //----Récupération du nombre de batiment-----------------
    $result_bate = mysqli_query($conn, "SELECT * FROM batiment");
    $nb_bate = mysqli_num_rows($result_bate);


    //---------Boucle pour l'affiachage des différentes tableaux------------
    for ($i = 1; $i <= $nb_bate; $i++) {
      echo "<h1>Batiment n°$i</h1>";

      //---------------------Récupération du nombre de salle-------------------
      $result_salle = mysqli_query($conn, "SELECT DISTINCT salle FROM capteur WHERE batiment = $i");
      $x = 0;
      while($row = mysqli_fetch_assoc($result_salle)) {
        $tab_salle[$x] = $row["salle"];
        //echo $tab_salle[$i];
        $x++;
      }
      $nb_salle = count($tab_salle);
      //-------------------------Boucle pour l'affichage des salles

      for ($j = 0; $j <= $nb_salle-1;$j++) {
        /*
        $query = "SELECT `id_mesure`, `date/heure` FROM `mesure`
        LIMIT 1
        INNER JOIN capteur ON `mesure.id_capteur` = `capteur.id_capteur`
        WHERE `capteur.salle` = `$tab_salle[$j]`
        ORDER BY `mesure.id_mesure` DESC";
        $temp_result = mysqli_query($conn, $query);
        echo $temp_result;
        */

        echo "<p>$tab_salle[$j]<p>";
        echo "<table border=\"5\" bordercolor=\"black\"><tr><th>temperature</th><th>luminosite</th></tr>";
        echo "<tr><td>5 à 18h00</td><td>8</td></tr></table>";

        

      }
    }


    ?>
</body>
</html>