#!/opt/lampp/bin/php
<?php

//---------------------connexion a la base de donnee---------------------
$servername = "localhost";
$username = "eliott";
$password = "bonjour";
$dbname = "bd_sae23";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); //connection to database
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else {
  echo "connexion reussi";
  echo "<br>";
}


//-----------------creation of the table with the rooms and their ID----------------
$salle_query = mysqli_query($conn, "SELECT id_capteur FROM capteur"); //query to retrieve sensor ids from the sensor table
$nb_salle = mysqli_num_rows($salle_query); //recovery of the number of rooms
$tab = array(); //creation of the table
for ($j = 1; $j <= $nb_salle; $j++) { //loop for setup id_sensor
  $k=$j-1; 
  $tab[$j][1]=$j;  //id_sensor



  $bate_query = mysqli_query($conn, "SELECT batiment FROM capteur LIMIT 1 OFFSET $k"); //request to recover building of the sensor table
  $batiment = mysqli_fetch_array($bate_query); //recovery of data in a php table
  foreach($batiment as $bate){}
  $tab[$j][2]=$bate;  //building number


  $capteur_query = mysqli_query($conn, "SELECT type FROM capteur LIMIT 1 OFFSET $k"); //request to recover building of the sensor table
  $capteurs = mysqli_fetch_array($capteur_query); //recovery of data in a php table
  foreach($capteurs as $capteur){}
  $tab[$j][3]=$capteur; //sensor type
  //echo $tab[$j][3];
  //echo "<br/>";

  $salle_query = mysqli_query($conn, "SELECT salle FROM capteur LIMIT 1 OFFSET $k"); //request to recover building of the sensor table
  $num_salles = mysqli_fetch_array($salle_query); //recovery of data in a php table
  foreach($num_salles as $num_salle){}
  $tab[$j][4]=$num_salle; //room
  //echo $tab[$j][4];
  //echo "<br/>";

  $id_cap = $tab[$j][1];
  $n_bat = $tab[$j][2];
  $type_cap = $tab[$j][3];
  $sa = $tab[$j][4];

  $tab[$j][5] = "sae/bate$n_bat/$sa/$type_cap"; //creation of the topic according to the information
  //echo $tab[$j][5];
  //echo "<br/>";

}


//-------------publication of the data on the comic----------------

for ($i = 1; $i <= $nb_salle; $i++){
  $topic = $tab[$i][5];
  $id_capteur = $tab[$i][1];
  $value = `mosquitto_sub -h localhost -t $topic -C 1`; //retrieve the data from the MQTT server
  echo $value;
  $sql = "INSERT INTO mesure (id_capteur, valeur) VALUES ( $id_capteur , $value )" //request to send the data to the database
  if (mysqli_query($conn, $sql)) { //check if the data has been sent
    echo "Mesure ajoutée";
    } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}


?>