<html>
  <head>
    <?php
        $db_username = 'max';
        $db_password = 'Maxime23@';
        $db_name     = 'sae23';
        $db_host     = 'localhost';
        $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
               or die('Impossible de se connecter a la base de données');

?>
    <title>insertion de données en PHP</title>
  </head>
<body>
<form name="insertion" action="insertion.php" method="POST">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>nom(bate + numéro)</td>
      <td><input type="text" name="nom"></td>
    </tr>
    <tr align="center">
      <td>login</td>
      <td><input type="text" name="prenom"></td>
    </tr>
    <tr align="center">
      <td>mot de passe</td>
      <td><input type="text" name="adresse"></td>
    </tr>

    <tr align="center">
      <td colspan="2"><input type="submit" value="insérer"></td>
    </tr>
  </table>
</form>
</body>
</html>