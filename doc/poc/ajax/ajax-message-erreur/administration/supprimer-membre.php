<?php
session_start();

if (!empty($_SESSION)) {
    if ($_SESSION['admin']){
        
    }else{
        echo '<script type="text/javascript">';  
        echo 'window.location.href = "../index.php";';
        echo 'history.go(-1);';
        echo '</script>';
    }
}else{
    echo '<script type="text/javascript">';  
    echo 'window.location.href = "../index.php";';
    echo 'history.go(-1);';
    echo '</script>';
}

require "../configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

$noMembre = $_GET['membre'];

if (empty($noMembre)){        
    echo '<script type="text/javascript">'; 
    echo 'alert("Erreur dans la supression!");'; 
    echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}else{
    $reussiteSupprimer = MembreDAO::supprimerMembre($noMembre);
    
    if($reussiteSupprimer){
        echo '<script type="text/javascript">'; 
        echo 'alert("Le membre a été supprimée de la base de données!");'; 
        echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
        echo '";';
        echo '</script>';
    }  
}
?>