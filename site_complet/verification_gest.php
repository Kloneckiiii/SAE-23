
<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connection to the database
    $db_username = 'max';
    $db_password = 'Maxime23@';
    $db_name = 'bd_sae23';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('Impossible de se connecter a la base de données');
    
    // we apply the two functions mysqli_real_escape_string and htmlspecialchars
    // to eliminate SQL injection and XSS attacks
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM batiment where 
              login2 = '".$username."' and mdp = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];

        if($count!=0) //  correct username and password
        {
           $_SESSION['username'] = $username;
           header('Location: page_gest.php');
        }
        else
        {
           header('Location: login_gest.php?erreur=1'); // incorrect user or password
        }
    }
    else
    {
       header('Location: login_gest.php?erreur=2'); //  empty user or password
}
}
else
{
   header('Location: login_gest.php');
}

$user="";
$query = "SELECT * FROM batiment WHERE batiment.user = '$user'";
$result = mysqli_query($db, $query);
  while ($bate = mysqli_fetch_assoc($result)) {

    if ($i =$bate["bate"])
     {
      $_POST [$i];
  }
}
mysqli_close($db);//close the connection
?>