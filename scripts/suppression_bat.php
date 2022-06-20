<?php
$sql2 = "DELETE FROM batiment WHERE id_bat=4";
if (mysqli_query($db, $sql2)){
    echo "Enregistrement supprimé avec succès";
} else 
{
    echo "Erreur lors de la suppression ";
}
?>