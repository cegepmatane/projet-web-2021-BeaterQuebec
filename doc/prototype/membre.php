<?php
require_once "configuration.php";
require_once CHEMIN_ACCESSEUR . "MembreDAO.php";

include "entete.php";

$estConnecte = false;

if(isset($_SESSION["pseudonyme"]))
    $estConnecte = true;

$membre = [];

if(!$estConnecte && isset($_POST["action-connexion"])){    
    $membre = MembreDAO::ValiderConnexion(new Membre($_POST));

    $estConnecte = isset($membre->id);

    if ($estConnecte){
        $_SESSION["id"] = $membre->id;
        $_SESSION["estConnecte"] = true;
        $_SESSION["pseudonyme"] = formater($membre->pseudonyme);
        $_SESSION["nom"] = formater($membre->nom);
        $_SESSION["prenom"] = formater($membre->prenom);
        $_SESSION["email"] = formater($membre->email);
        $_SESSION["admin"] = $membre->admin;
        $_SESSION["motDePasse"] = formater($membre->motDePasse);
        
        echo '<script type="text/javascript">'; 
        echo 'window.location.href = "membre.php";';
        echo '</script>';
    }
    else {
        //$membre = MembreDAO::lireMembreParPseudonyme($_SESSION["pseudonyme"]);
        echo '<script type="text/javascript">'; 
        echo 'alert("Erreur de connexion, veuillez réessayer!");'; 
        echo 'window.location.href = "membre.php";';
        echo '</script>';
    }
}

if (!$estConnecte){
    include "authentification.php";
}
else{
    include "profil.php";
}

include "pied-page.php";
?>