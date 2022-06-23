<?php
//connection to the database
$db_username = 'max';
$db_password = 'Maxime23@';
$db_name     = 'bd_sae23';
$db_host     = 'localhost';

//SQL query

$query="SELECT * FROM batiment";

$result=mysqli_query($conn, $query);


if (isset($_POST["AJOUTER"])){
//add variable to automate the addition of buildings
     $Nom=$_POST["Nom"];
     $login=$_POST["login2"];
     $mdp=$_POST["mdp"];
    //SQL query
     $sql= "INSERT INTO batiment(Nom,login2,mdp) VALUES ('$Nom','$login',$mdp)";
   
     $res2=mysqli_query($conn, $sql) ;

    //redirection to the page : page-admin.php  
  header("location:page-admin.php");
   

   }
   ?>