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
                <li><a href="page_consultation.html"> consultation des données </a> </li>
                <li><a href="connexion.html"> se connecter </a> </li>
            </ul>
        </nav>
<?php

    //---------------------connexion a la base de donnee---------------------
    $servername = "localhost";
    $username = "eliott";
    $password = "bonjour";
    $dbname = "bd_sae23";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        //echo "connexion reussi";
        echo "<br>";
    }
?>

<form method="POST" action="Page_Affichage.php"/>

<?php
    //----------------------Recuperation de la salle par gestionnaire-------------
    $query_salle = "SELECT DISTINCT `capteur`.`salle`
        FROM `capteur`
        INNER JOIN `batiment` ON `batiment`.`id_bat` = `capteur`.`batiment`
        WHERE `batiment`.`id_bat` = '1'"; //requete pour récupérer les salles sur la base de donnée en fonction du gestionnaire connecter
    $result_salle = mysqli_query($conn, $query_salle); //execution de la requete sql vers la base de donnée
    $nb_salle = mysqli_num_rows($result_salle); //variable avec le nombre de salle
    for ($i = 0; $i <= $nb_salle-1; $i++){ //boucle pour crée autant de rubrique qu'il n'y  a de salle
        $j = 0;
        while($row = mysqli_fetch_array($result_salle)) {
            $salle[$i] = $row[0];
            echo "<fieldset><legend>$salle[$i]</legend>
                    <label for='date$j'>Le </label>
                    <input type='date' min='2022-06-15' name='date$j'>
                    <label for='heure1_$j'>entre </label>
                    <input type='time' name='heure1_$j'/>
                    <label for='heure2_$j'>et </label>
                    <input type='time' name='heure2_$j'/></fieldset>"; //génération du formulaires en fonction du gestionnaire et du nombre de salle
            $j++;
        }
    }
?>
<input type="submit" name="submit" value="Valider" />
</form>
</body>
</html>