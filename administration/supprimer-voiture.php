<?php
require "../configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$noVoiture = $_GET['voiture'];

if (empty($noVoiture)){        
    echo '<script type="text/javascript">'; 
    echo 'alert("Erreur dans la supression!");'; 
    echo 'window.location.href = "liste-voiture.php";';
    echo '</script>';
}else{
    $reussiteSupprimer = VoitureDAO::supprimerVoiture($noVoiture);
    
    if($reussiteSupprimer){
        echo '<script type="text/javascript">'; 
        echo 'alert("La Voiture a été supprimée de la base de données!");'; 
        echo 'window.location.href = "liste-voiture.php";';
        echo '</script>';
    }  
}
?>