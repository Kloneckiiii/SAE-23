<!DOCTYPE html>
<html lang="fr">
<head>
<title>page_consultation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
<meta http-equiv= "X-UA-Compatible" content= "IE=edge" />
<meta name="author" content="G2" />
<meta name="description" content="SAE24" />
<meta name="keywords" content="HTML, CSS" />
<link rel="stylesheet" type="text/css" href="CSS/style.css" />

 <?php // conexion to the database
	$servername = "localhost";
	$username = "eliott";
	$password = "bonjour";
	$dbname = "bd_sae23";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
?>	
 </head>
   <body>	
    	<nav>
        	<ul>
            <li> <a href="index.html"> Accueil </a></li>
      		<li><a href="problèmes.html">Problèmes rencontrés </a></li>
            <li><a href="gantt.html"> GANTT </a></li>  
            <li><a href="mentions_legales.html"> Mentions légales </a> </li>
            <li><a href="page_consultation.html"> consultation des données </a> </li>
    		</ul>
    	</nav>
		<br>
		<br>
		<h1> Consultation des données </h1>
		<section>
		<p>Vous pouvez consulter la dernière mesure de chacune des salles</p>

		<?php
 		//----Retrieval of the number of buildings-----------------
		$result_bate = mysqli_query($conn, "SELECT * FROM batiment"); //execution d'une requete sql pour récupérer la table batiment
		 $nb_bate = mysqli_num_rows($result_bate); //variable avec les nombres de batiment

 		//---------Loop for displaying the different tables------------
 		for ($i = 1; $i <= $nb_bate; $i++) {
  		echo "<h1>Batiment n°$i</h1>";

   	//---------------------Recovery of the number of rooms-------------------
  		$result_salle = mysqli_query($conn, "SELECT DISTINCT salle FROM capteur WHERE batiment = $i"); //execution requete sql pour récupérer les salles en fonctions du batiment
   	$x = 0;
   	while($row = mysqli_fetch_assoc($result_salle)) {  //boucle d'enregistrement des salles récupérer depuis la base de donnée dans un tableau associatif
	     	$tab_salle[$x] = $row["salle"];
	     	$x++;
   	}
   	$nb_salle = count($tab_salle); //variable with the number of rooms

   	//-------------------------Loop for viewing rooms---------------
   	for ($j = 0; $j <= $nb_salle-1;$j++) {
     
			//----------------------recovery of the last temperature value
			$query_temp = "SELECT `mesure`.`valeur`, `mesure`.`date/heure`
				FROM `mesure` 
				LEFT JOIN `capteur` ON `mesure`.`id_capteur` = `capteur`.`id_capteur`
				WHERE `capteur`.`salle` = '$tab_salle[$j]' AND `capteur`.`type` = 'temperature'
				ORDER BY `mesure`.`id_mesure` DESC
				LIMIT 1";//requete sql pour récupérer la  valeur et l'heure de la dernière mesure de la température en fonction de la salle et du capteur
				$temp_result = mysqli_query($conn, $query_temp); //execution de la requete sql vers la base de donnée
				while($row = mysqli_fetch_assoc($temp_result)) { //boucle d'enregistrement des mesures récupérer depuis la base de donnée dans un tableau associatif
					$temperature_value[$j] = $row["valeur"];
					$temperature_date[$j] = $row["date/heure"];
					$x++;
				}

	     //---------------------------recovery of the last temperature value
	     $query_lum = "SELECT `mesure`.`valeur`, `mesure`.`date/heure`
		     FROM `mesure` 
		       LEFT JOIN `capteur` ON `mesure`.`id_capteur` = `capteur`.`id_capteur`
		     WHERE `capteur`.`salle` = '$tab_salle[$j]' AND `capteur`.`type` = 'luminosite'
		     ORDER BY `mesure`.`id_mesure` DESC
		     LIMIT 1"; //sql query to retrieve the value and time of the last light measurement according to the room and the sensor
	     $lum_result = mysqli_query($conn, $query_lum); //execute sql query to database
	     while($row = mysqli_fetch_assoc($lum_result)) { //measurement recording loop retrieve from the database in an associative array
	         $luminosite_value[$j] = $row["valeur"];
	         $luminosite_date[$j] = $row["date/heure"];
	         $x++;
	      }

	     echo "<h3>$tab_salle[$j]</h3>";
	     echo "<table border=\"5\" bordercolor=\"black\"><tr><th>temperature</th><th>luminosite</th></tr>"; //creation of the table with its temperature and brightness header
	     echo "<tr><td>$temperature_value[$j]° à $temperature_date[$j]</td><td>$luminosite_value[$j] lum à $luminosite_date[$j]</td></tr></table>"; //display of the last measurement in the table
   	}
   }	
?>
</body>
</html>
