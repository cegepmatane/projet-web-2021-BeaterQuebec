<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

$p = $_REQUEST["p"];
$c = $_REQUEST["c"];

$erreur = "";

if ($p !== "") {
    $checkPseudonyme = MembreDAO::lireMembreParPseudonyme($p);

    if (isset($checkPseudonyme->id)){
        $erreur = "Ce nom d'utilisateur éxiste déjà!";
    } 
}

if ($c !== "") {
  $checkCourriel = MembreDAO::lireMembreParCourriel($c);

    if (isset($checkCourriel->id)){ 
        $erreur = "Cette addresse de courriel éxiste déjà!";
    }
}

echo $erreur === "" ? "" : $erreur;
?>