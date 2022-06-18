








<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css"  />
    </head>
    <?php
//identification
define ('DB_SERVER', 'localhost');
define ('DB_USERNAME', 'max');
define ('DB_PASSWORD', 'Maxime23@');
define ('DB_NAME', 'sae23');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


$query_sql = "SELECT login2, mot_de_passe FROM administration";
$result_sql = mysqli_query( $conn,$query_sql);
$sql = mysqli_fetch_assoc($result_sql);

 if (username = $sql["login2"] and password = $sql["mot_de_pass"]);{
        echo "<p>connexion réussi</p>
    } 
   

    else {


        echo "Connexion echouée"
}

  ?>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="page_admin.html" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <div class="c100 id="submit">
                <p><input type="submit" id='submit' value='LOGIN'>
            </div>
            
            </form>
        </div>
    </body>
</html>