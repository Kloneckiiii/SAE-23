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
}


//-----------------creation du tableau avec les salles et leurs ID----------------
$salle_query = mysqli_query($conn, "SELECT id_capteur FROM capteur");
$nb_salle = mysqli_num_rows($salle_query);



$tab = array();

$i=1;
$nb_salle = 2;
for ($j = 1; $j <= $nb_salle; $j++) {

  $k=$j-1;

  $tab[$j][1]=$j;  //id_capteur
  echo $tab[$j][1];
  echo "<br/>";


  $bate_query = mysqli_query($conn, "SELECT batiment FROM capteur LIMIT 1 OFFSET $k");
  $batiment = mysqli_fetch_array($bate_query);
  foreach($batiment as $bate){}
  $tab[$j][2]=$bate;  //numéro du batiment
  echo $tab[$j][2];

  echo "<br/>";

  $capteur_query = mysqli_query($conn, "SELECT type FROM capteur LIMIT 1 OFFSET $k");
  $capteurs = mysqli_fetch_array($capteur_query);
  foreach($capteurs as $capteur){}
  $tab[$j][3]=$capteur; //type de capteur
  echo $tab[$j][3];
  echo "<br/>";

  $salle_query = mysqli_query($conn, "SELECT salle FROM capteur LIMIT 1 OFFSET $k");
  $num_salles = mysqli_fetch_array($salle_query);
  foreach($num_salles as $num_salle){}
  $tab[$j][4]=$num_salle; //salle
  echo $tab[$j][4];
  echo "<br/>";

  $tab[$j][5] = "sae/bate $tab[$i][2] / $tab[$i][4] / $tab[$i][3] ";
  echo $tab[$j][5];
  echo "<br/>";
  echo "<br/>";
  echo "<br/>";

}


$i=1;
//$value = `mosquitto_sub -h localhost -t sae/bate$tab[$i][2]/$tab[$i][4]/$tab[$i][3] -C 1`;
//  echo $value;


//-------------publication des donnees sur la BD----------------
/*
for ($i = 1; $i <= $nb_salle; $i++){
  $value = `mosquitto_sub -h localhost -t sae/bate$tab[$i][2]/$tab[$i][4]/$tab[$i][3] -C 1`;
  echo $value;
  $sql = "INSERT INTO mesure (id_capteur, valeur) VALUES ($tab[$i][1], $value )";
  if (mysqli_query($conn, $sql)) {
    echo "Mesure ajoutée";
    } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}

*/
?>