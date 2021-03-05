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

$filtresMembre = [];

$filtresMembre['motDePasse'] = FILTER_SANITIZE_ENCODED;

$membre = filter_input_array(INPUT_POST, $filtresMembre);

if (empty($membre['motDePasse'])){
    echo '<script type="text/javascript">'; 
    echo 'alert("Veuillez remplir tout les champs!");'; 
    echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}

$membreNouveauMotDePasse = password_hash($membre['motDePasse'], PASSWORD_DEFAULT);
$reussiteModification = MembreDAO::modifierMotDePasseParPseudonyme($membreNouveauMotDePasse,$_GET['pseudonyme']);

if($reussiteModification){
    echo '<script type="text/javascript">'; 
    echo 'alert("Le membre a été modifié dans la base de données");'; 
    echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}

?>