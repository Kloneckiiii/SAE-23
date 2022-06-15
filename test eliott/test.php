#!/opt/lampp/bin/php
<?php

//---------------------connexion a la base de donnee---------------------
$servername = "localhost";
$username = "eliott";
$password = "bonjour";
$dbname = "sae23";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else {
  echo "connexion reussi";
  echo "<br>";


//-----------------creation du tableau avec les salles et leurs ID----------------
$nb_salle = 8;
/*
$tab;

for ($j = 1; $j <= $nb_salle; $j++) {
    $tab[$j][1]=$num_salle;
    $tab[$j][2]=$j;
    $tab[$j][3]=$bate;
    $tab[$j][4]=$capteur
}
*/

//-------------publication des donnees sur la BD----------------

for ($i = 1; $i <= $nb_salle; $i++){
  $value = `mosquitto_sub -h localhost -t sae/bate$tab[$i][3]/$tab[$i][1]/$tab[$i][4] -C 1`;
  $sql = "INSERT INTO mesure (id_capteur, valeur) VALUES ($tab[$i][2], $value )";
  if (mysqli_query($conn, $sql)) {
    echo "Mesure ajoutée";
    } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}



//$value = `mosquitto_sub -h localhost -t sae/bate2/E202/temperature -C 1`;
//echo $value;



?>