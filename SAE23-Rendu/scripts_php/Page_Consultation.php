<!DOCTYPE html>
<html lang="fr">
 <head>
    <title>connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta http-equiv= "X-UA-Compatible" content= "IE=edge" />
    <meta name="author" content="G2" />
    <meta name="description" content="SAE24" />
    <meta name="keywords" content="HTML, CSS" />
    <link rel="stylesheet" type="text/css" href="CSS/style.css" />
 </head>
    <body>
        <nav>
            <ul>
              <li> <a href="index.html"> Accueil </a></li>
              <li><a href="problèmes.html">Problèmes rencontrés </a></li>
              <li><a href="gantt.html"> GANTT </a></li>
              <li><a href="mentions_legales.html"> Mentions légales </a> </li>
              <li><a href="Page_Consultation.php"> Consultation des donnnees </a></li>
              <li><a href="login_admin.php">Admin</a></li>
              <li><a href="login_gest.php">Gestionnaires</a></li>
            </ul>
        </nav>
        <?php
//---------------------connection to the database---------------------
$servername = "localhost";
$username = "eliott";
$password = "bonjour";
$dbname = "bd_sae23";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); //connection to the database

?>
<html>
<body>
  <section>
    <p>Vous pouvez consulter la dernière mesure de chacune des salles</p>
    <?php

      //----Recovery of the number of buildings-----------------
      $result_bate = mysqli_query($conn, "SELECT * FROM batiment"); //recovery of the building table
      $nb_bate = mysqli_num_rows($result_bate); //calculation of the number of buildings

      //---------Loop for the display of the different tables------------
      for ($i = 1; $i <= $nb_bate; $i++) { //Loop creation of the tables according to the number of rooms
        echo "<h1>Batiment n°$i</h1>"; //Display the name of the current building

        //---------------------Recovery of the number of rooms-------------------
        $result_salle = mysqli_query($conn, "SELECT DISTINCT salle FROM capteur WHERE batiment = $i"); //recovery of the different rooms associated with the sensors
        $x = 0;
        while($row = mysqli_fetch_assoc($result_salle)) { //loop to register the name of the rooms
          $tab_salle[$x] = $row["salle"]; //registration of rooms in a variable
          $x++;
        }
        $nb_salle = count($tab_salle);

        //-------------------------Loop for room display--------------------
        for ($j = 0; $j <= $nb_salle-1;$j++) {

          //----------------------retrieval of the last temperature value
          $query_temp = "SELECT `mesure`.`valeur`, `mesure`.`date/heure`
                        FROM `mesure` 
                          LEFT JOIN `capteur` ON `mesure`.`id_capteur` = `capteur`.`id_capteur`
                        WHERE `capteur`.`salle` = '$tab_salle[$j]' AND `capteur`.`type` = 'temperature'
                        ORDER BY `mesure`.`id_mesure` DESC
                        LIMIT 1"; //request to have the value and the date of a single temperature measurement according to its room and its building
          $temp_result = mysqli_query($conn, $query_temp);  //query execution
          while($row = mysqli_fetch_assoc($temp_result)) { //loop to save data in php tables
            $temperature_value[$j] = $row["valeur"];
            $temperature_date[$j] = $row["date/heure"];
            $x++;
          }

          //---------------------------retrieval of the last temperature value
          $query_lum = "SELECT `mesure`.`valeur`, `mesure`.`date/heure`
                      FROM `mesure` 
                        LEFT JOIN `capteur` ON `mesure`.`id_capteur` = `capteur`.`id_capteur`
                      WHERE `capteur`.`salle` = '$tab_salle[$j]' AND `capteur`.`type` = 'luminosite'
                      ORDER BY `mesure`.`id_mesure` DESC
                      LIMIT 1"; //request to have the value and date of a single light measurement according to its room and building
          $lum_result = mysqli_query($conn, $query_lum); //execution of the sql query
          while($row = mysqli_fetch_assoc($lum_result)) {  //loop to save data in php tables
            $luminosite_value[$j] = $row["valeur"];
            $luminosite_date[$j] = $row["date/heure"];
            $x++;
          }
          echo "<h3>$tab_salle[$j]</h3>"; //Display of the room
          echo "<table border=\"5\" bordercolor=\"black\"><tr><th>temperature</th><th>luminosite</th></tr>"; //creation of the table
          echo "<tr><td>$temperature_value[$j]° à $temperature_date[$j]</td><td>$luminosite_value[$j] lum à $luminosite_date[$j]</td></tr></table>"; //insertion of the different values in the table
        }
      }
    ?>
</body>
</html>