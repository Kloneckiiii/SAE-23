
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
    <link rel="stylesheet" type="text/css" href="CSS/style_admin.css" />
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
        <h2>Affichage d'une donnée par salle</h2>
<?php

    //---------------------database connection---------------------
    $servername = "localhost";
    $username = "max";
    $password = "Maxime23@";
    $dbname = "bd_sae23";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname); //connection to the database
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_ezrror());
    }
    else {
        echo "connexion reussi";
    }
?>
<!--creation of the form for room and time slot selection -->
<form method="POST" action="Page_Affichage.php"> 

<?php
    //----------------------Recovery of the room by manager-------------
    $query_salle = "SELECT DISTINCT `capteur`.`salle`
        FROM `capteur`
        INNER JOIN `batiment` ON `batiment`.`id_bat` = `capteur`.`batiment`
        WHERE `batiment`.`id_bat` = '1'"; //query to retrieve rooms from the database according to the connected manager
    $result_salle = mysqli_query($conn, $query_salle); //execution of the sql query to the database
    $nb_salle = mysqli_num_rows($result_salle); //variable with the number of rooms
    for ($i = 0; $i <= $nb_salle-1; $i++){ //loop to create as many sections as there are rooms
        $j = 0;
        while($row = mysqli_fetch_array($result_salle)) { //display of the form according to the rooms
            $salle[$i] = $row[0];
            echo "<fieldset><legend>$salle[$i]</legend>
                    <label for='date$j'>Le </label>
                    <input type='date' min='2022-06-15' name='date$j'>
                    <label for='heure1_$j'>entre </label>
                    <input type='time' name='heure1_$j'/>
                    <label for='heure2_$j'>et </label>
                    <input type='time' name='heure2_$j'/></fieldset>"; //generation of the forms according to the manager and the number of rooms
            $j++;
        }
    }
?>
<input type="submit" name="submit" value="Valider" /> <!--button to send to the data display page -->
</form>
</body>
</html>
