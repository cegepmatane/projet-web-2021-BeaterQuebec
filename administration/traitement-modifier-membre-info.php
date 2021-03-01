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

$filtresMembre['pseudonyme'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['email'] = FILTER_SANITIZE_STRING;
$filtresMembre['nom'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['prenom'] = FILTER_SANITIZE_ENCODED;

$membre = filter_input_array(INPUT_POST, $filtresMembre);
if(strcmp($_GET['pseudonyme'],$membre["pseudonyme"]))
{
    $checkPseudonyme = MembreDAO::lireMembreParPseudonyme($membre["pseudonyme"]);
    if (isset($checkPseudonyme->id))
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Ce nom d\'utilisateur éxiste déjà!");'; 
        echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
        echo '";';
        echo '</script>';
    } 
}
if(strcmp($_GET['email'],$membre["email"]))
{
    $checkCourriel = MembreDAO::lireMembreParCourriel($membre["email"]);
    if (isset($checkCourriel->id))
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Cette addresse de courriel éxiste déjà!");'; 
        echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
        echo '";';
        echo '</script>';
    } 
}
$reussiteModification = MembreDAO::modifierMembreInfo($membre);
if($reussiteModification){
    echo '<script type="text/javascript">'; 
    echo 'alert("Le membre a été modifié dans la base de données");'; 
    echo 'window.location.href = "liste-membre.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
} 

?>