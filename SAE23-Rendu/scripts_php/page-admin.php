<?php

//Connection to the database
$db_username = 'max';
$db_password = 'Maxime23@';
$db_name     = 'sae23';
$db_host     = 'localhost';

  $conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);
//include the file : add_bat.php
include ("add_bat.php");

?>
<!--DOCTOTYPE html-->
<html>
<link rel="stylesheet" type="text/css" href="style_admin.css" />
  <head>
    <title></title>
</head>
<body>
<nav>
        	<ul>
            <li> <a href="C:\MAMP\htdocs\site\lindex.html"> Accueil </a></li>
      		  <li><a href="C:\MAMP\htdocs\site\problèmes.html">Problèmes rencontrés </a></li>
            <li><a href="C:\MAMP\htdocs\site\gantt.html"> GANTT </a></li>  
            <li><a href="C:\MAMP\htdocs\site\mentions_legales.html"> Mentions légales </a> </li>

    			</ul>
    	</nav>
  <!--HTML form-->
  <form action="page-admin.php" method="POST">
    <br><br>
    <br></br>
    <input type="hidden" name="id_bat"><br>
    <label>Nom du batiment</label>
    <input type="text" name="Nom"><br>
    <br><br>
    <label>login</label>
    <input type="text" name="login2"><br>
    <br><br>
    <label>mot de passe</label>
    <input type="text" name="mdp"><br>
<!--creation of the add button-->
    <input type="submit" name="add" value="AJOUTER">
</form>

<table>
  <!--Creation of a table-->
  <th>id</th>
  <th>nom du batiment</th>
  <th>login</th>
  <th>Mot de passe</th>
  <th>Supprimer</th>
  <?php
  //SQL query
  //select all in the building table
$sql="SELECT * FROM batiment";
$result = mysqli_query($conn, $sql);

//loop while
  while ( $row = mysqli_fetch_assoc($result))

{
  //Show received data
  echo "<tr><td>"
  .$row["id_bat"]."</td><td>"
  .$row["Nom"]."</td><td>"
  .$row["login2"]."</td><td>"
  .$row["mdp"]."</td><td>"
  ."<td><a href='supprimer_page-admin.php?id_bat=".$row["id_bat"]."'>supprimer<a></td>";
  
}

?>
</body>
</html>

    