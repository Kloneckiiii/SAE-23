<!DOCTYPE html>
<html lang="fr">
<head>
    <title>connexion</title>
    <meta charset="UTF-8">

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
$result_salle = mysqli_query($conn, "SELECT DISTINCT salle FROM capteur WHERE batiment = 1");
$nb_salle = mysqli_num_rows($result_salle);

for ($i = 0; $i < $nb_salle; $i++) {
    $row = mysqli_fetch_array($result_salle);
        $salle[$i] = $row[0];

        if(!empty($_POST["date$i"])) {
            echo "<h1>$salle[$i]</h1>";
            $date = $_POST["date$i"];
            $heure1 = $_POST["heure1_$i"];
            $heure2 = $_POST["heure2_$i"];
            $requete1 = "$date $heure1:00";
            $requete2 = "$date $heure2:00";


            //----------------------------partie temperature--------------------------------
            $query_temp = "SELECT `mesure`.`valeur` FROM `mesure`
            INNER JOIN `capteur` ON `capteur`.`id_capteur` = `mesure`.`id_capteur`
            WHERE `mesure`.`date/heure` BETWEEN '$date $heure1' AND '$date $heure2'
            AND `capteur`.`salle` = '$salle[$i]'
            AND `capteur`.`type` = 'temperature'";
            $result_temp = mysqli_query($conn, $query_temp);
            $nb_temp = mysqli_num_rows($result_temp);
            $min = 500;
            $max = 0;
            $average = 0;
            echo "<p>Voici les temperatures de la salle $salle[$i] du $date de $heure1 à $heure2 :</p>";
            echo "<table border=\"5\" bordercolor=\"black\"><tr><th>temperature</th></tr>";
            for ($x =0; $x < $nb_temp; $x++) {
                $row = mysqli_fetch_assoc($result_temp);
                $temp_value = $row["valeur"];
                echo "<tr><td>$temp_value °C</td><td7</td></tr>";
                if ($temp_value < $min) {
                    $min = $temp_value;
                }
                if ($temp_value > $max) {
                    $max = $temp_value;
                }
                $average = $average + $temp_value;
            }
            $average = $average / $nb_temp;
            echo "</table>";
            echo "><div style=\"border:2px solid black;
            text-align:center; width:500px\">
            <p>Le relever minimum est: $min °C</p>
            <p>Le relever maximum est: $max °C</p>
            <p>La moyenne de la salle est: $average °C</p>
            </div>";


            //-------------------partie luminosite---------------------------------
            $query_lum = "SELECT `mesure`.`valeur` FROM `mesure`
            INNER JOIN `capteur` ON `capteur`.`id_capteur` = `mesure`.`id_capteur`
            WHERE `mesure`.`date/heure` BETWEEN '$date $heure1' AND '$date $heure2'
            AND `capteur`.`salle` = '$salle[$i]'
            AND `capteur`.`type` = 'luminosite'";
            $result_lum = mysqli_query($conn, $query_lum);
            $nb_lum = mysqli_num_rows($result_lum);
            $min = 500;
            $max = 0;
            $average = 0;
            echo "<p>Voici les luminosites de la salle $salle[$i] du $date de $heure1 à $heure2 :</p>";
            echo "<table border=\"5\" bordercolor=\"black\"><tr><th>luminosite</th></tr>";
            for ($x =0; $x < $nb_temp; $x++) {
                $row = mysqli_fetch_assoc($result_lum);
                $lum_value = $row["valeur"];
                echo "<tr><td>$lum_value lum</td><td7</td></tr>";
                if ($lum_value < $min) {
                    $min = $lum_value;
                }
                if ($lum_value > $max) {
                    $max = $lum_value;
                }
                $average = $average + $lum_value;
            }
            $average = $average / $nb_temp;
            echo "</table>";
            echo "<div style=\"border:2px solid black;
            text-align:center; width:500px\">
            <p>Le relever minimum est: $min lum</p>
            <p>Le relever maximum est: $max lum</p>
            <p>La moyenne de la salle est: $average lum</p>
            </div>";

        }
       
    
    
}
?>
</body>
</html>