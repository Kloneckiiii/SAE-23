<?php
$db_username = 'max';
$db_password = 'Maxime23@';
$db_name     = 'sae23';
$db_host     = 'localhost';

  $conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);

if (isset($_GET["id_bat"])){
//SQL query to delete columns
 $ids=$_GET["id_bat"];
 $sql="DELETE FROM `batiment` WHERE id_bat = $ids";

  mysqli_query($conn,$sql);
//redirect to the admin page
  header("location:page-admin.php");
}

?>