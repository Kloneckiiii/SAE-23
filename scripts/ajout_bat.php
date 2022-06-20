<?php
$db_username = 'max';
$db_password = 'Maxime23@';
$db_name     = 'sae23';
$db_host     = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
       or die('Impossible de se connecter a la base de données');

$sql = "INSERT INTO batiment (Nom,login2,mdp) VALUES ('bate4','maxime','123')";
if (mysqli_query($db, $sql)){
echo "Nouveau batiment bien enregistré";

} else {
echo "Erreur d enregistrement";
}
mysqli_close($db);
?>