<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

session_start();

$filtresMembre = [];

$filtresMembre['ancienMotDePasse'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['confirmationMotDePasse'] = FILTER_SANITIZE_ENCODED;

$membre = filter_input_array(INPUT_POST, $filtresMembre);

$hasedPwdCheck = password_verify(formater($membre['ancienMotDePasse']), $_SESSION["motDePasse"]);

if(!$hasedPwdCheck){
    echo '<script type="text/javascript">'; 
    echo 'alert("Mot de passe incorrect!");'; 
    echo 'window.location.href = "membre.php";';
    echo '</script>';
}
else{
    $membreNouveauMotDePasse = password_hash($membre['confirmationMotDePasse'], PASSWORD_DEFAULT);

    $changerMotDePasse = MembreDAO::modifierMotDePasse($membreNouveauMotDePasse);
    
    $_SESSION["motDePasse"] = $membreNouveauMotDePasse;

    header("Location: membre.php");
    die();	
}


?>
