#!/opt/lampp/bin/php
<?php

//---------------------connexion a la base de donnee---------------------
$servername = "localhost";
$username = "eliott";
$password = "bonjour";
$dbname = "bd_sae23";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); //connexion a la base de donnee
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else {
  echo "connexion reussi";
  echo "<br>";
}


//-----------------creation du tableau avec les salles et leurs ID----------------
$salle_query = mysqli_query($conn, "SELECT id_capteur FROM capteur"); //requete pour recupérer les id capteurs de la table capteur
$nb_salle = mysqli_num_rows($salle_query); //execution de la requete
$tab = array();
for ($j = 1; $j <= $nb_salle; $j++) {
  $k=$j-1;
  $tab[$j][1]=$j;  //id_capteur



  $bate_query = mysqli_query($conn, "SELECT batiment FROM capteur LIMIT 1 OFFSET $k"); //requete pour récupérer batiement de la table capteur
  $batiment = mysqli_fetch_array($bate_query); //execution de la requete
  foreach($batiment as $bate){}
  $tab[$j][2]=$bate;  //numéro du batiment


  $capteur_query = mysqli_query($conn, "SELECT type FROM capteur LIMIT 1 OFFSET $k"); //requete pour récupérer batiement de la table capteur
  $capteurs = mysqli_fetch_array($capteur_query); //execution de la requete
  foreach($capteurs as $capteur){}
  $tab[$j][3]=$capteur; //type de capteur
  //echo $tab[$j][3];
  //echo "<br/>";

  $salle_query = mysqli_query($conn, "SELECT salle FROM capteur LIMIT 1 OFFSET $k"); //requete pour récupérer batiement de la table capteur
  $num_salles = mysqli_fetch_array($salle_query); //execution de la requete
  foreach($num_salles as $num_salle){}
  $tab[$j][4]=$num_salle; //salle
  //echo $tab[$j][4];
  //echo "<br/>";

  $id_cap = $tab[$j][1];
  $n_bat = $tab[$j][2];
  $type_cap = $tab[$j][3];
  $sa = $tab[$j][4];

  $tab[$j][5] = "sae/bate$n_bat/$sa/$type_cap";
  //echo $tab[$j][5];
  //echo "<br/>";

}


//-------------publication des donnees sur la BD----------------

for ($i = 1; $i <= $nb_salle; $i++){
  $topic = $tab[$i][5];
  $id_capteur = $tab[$i][1];
  $value = `mosquitto_sub -h localhost -t $topic -C 1`; //récupération de la donnée sur le serveur MQTT
  echo $value;
  $sql = "INSERT INTO mesure (id_capteur, valeur) VALUES ( $id_capteur , $value )" //requete pour envoyer la donnée sur la base de donnée
  if (mysqli_query($conn, $sql)) { //vérification si la donnée a bien été envoyé
    echo "Mesure ajoutée";
    } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}


?>