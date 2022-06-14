<?php
//identification
define ('DB_SERVER', 'localhost');
define ('DB_USERNAME', 'max');
define ('DB_PASSWORD', 'Maxime23@');
define ('DB_NAME', 'bd_saé23');

//Connexion bd
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//verifier connexion 
if($conn === false){
    die ("Impossible de se connecter.".mysqli_connect_error());
}
echo "Connexion réussie";

?>
