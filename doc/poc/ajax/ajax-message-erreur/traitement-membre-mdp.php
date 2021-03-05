<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

session_start();

$filtresMembre = [];

$filtresMembre['ancienMotDePasse'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['confirmationMotDePasse'] = FILTER_SANITIZE_ENCODED;

$membre = filter_input_array(INPUT_POST, $filtresMembre);

if (empty($membre['ancienMotDePasse']) || empty($membre['confirmationMotDePasse'])){
    echo '<script type="text/javascript">'; 
    echo 'alert("Veuillez remplir tout les champs!");'; 
    echo 'window.location.href = "membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}

$hasedPwdCheck = password_verify(formater($membre['ancienMotDePasse']), $_SESSION["motDePasse"]);

if(!$hasedPwdCheck){
    echo '<script type="text/javascript">'; 
    echo 'alert("Mot de passe incorrect!");'; 
    echo 'window.location.href = "membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}
else{
    $membreNouveauMotDePasse = password_hash($membre['confirmationMotDePasse'], PASSWORD_DEFAULT);

    $changerMotDePasse = MembreDAO::modifierMotDePasse($membreNouveauMotDePasse);
    
    $_SESSION["motDePasse"] = $membreNouveauMotDePasse;

    header("Location: membre.php?lang=".$_GET['lang']);
    die();	
}


?>
