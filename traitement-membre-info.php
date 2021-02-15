<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

session_start();

$filtresMembre = [];

$filtresMembre['pseudonyme'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['nom'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['prenom'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['email'] = FILTER_SANITIZE_ENCODED;
//Vérification pour nom
$membre = filter_input_array(INPUT_POST, $filtresMembre);
if (strcmp($membre['pseudonyme'],$_SESSION['pseudonyme'])){
    $checkPseudonyme = MembreDAO::lireMembreParPseudonyme($membre["pseudonyme"]);
    if (isset($checkPseudonyme->id))
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Ce nom d\'utilisateur éxiste déjà!");'; 
        echo 'window.location.href = "membre.php";';
        echo '</script>';
    } 
}
if (strcmp($membre['email'],$_SESSION['email'])){
    $checkCourriel = MembreDAO::lireMembreParCourriel($membre["email"]);
    if (isset($checkCourriel->id))
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Cette addresse de courriel éxiste déjà!");'; 
        echo 'window.location.href = "membre.php";';
        echo '</script>';
    } 
}
$reussiteModification = MembreDAO::modifierMembreInfo($membre);

if($reussiteModification) 
{
    $_SESSION["pseudonyme"] = formater($membre["pseudonyme"]);
    $_SESSION["nom"] = formater($membre["nom"]);
    $_SESSION["prenom"] = formater($membre["prenom"]);
    $_SESSION["email"] = formater($membre["email"]);
    header("Location: membre.php");
    die();	
}
    
?>
