<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$textMarque = $_REQUEST["marque"];
$textModele = $_REQUEST["modele"];
$prixMax = $_REQUEST["prix"];
$kilometragesMax = $_REQUEST["kilometrage"];
$min = $_REQUEST["min"];
$max = $_REQUEST["max"];


$listResultatRecherche = VoitureDAO::lireRechercheAvance($textMarque, $textModele, $min, $max, $prixMax, $kilometragesMax);

if (!empty($listResultatRecherche)){
    foreach($listResultatRecherche as $resultat)
    {

    
        echo '<div class="itemListeVoiture">
            <a class="lienListeVoiture" href="voiture.php?voiture='.$resultat->id.'&lang=' .$_REQUEST["lang"].'">
                <li class="voitureListeVoiture">
                    '; 
                        if(empty(formater($resultat->image))){echo "<img src= 'images/no-image-icon-0.jpg' alt='Miniature' class='imageListeVoiture'></img>";}else{echo "<img src='images/".formater($resultat->image)."' alt='Miniature' class='imageListeVoiture'></img>";} 
                    echo'
                    <h3>'.formater($resultat->marque)." ".formater($resultat->modele).'</h3>
                    <br>
                    <p class="descriptionListeVoiture">'; 
                    echo _("Prix : "); 
                    echo'<span style="color:#37A864;"$>$'.formater($resultat->prix).'</span></p>
                    <br>
                    <p class="descriptionListeVoiture">';
                    echo _("Kilométrages : ");
                    echo formater($resultat->kilometrages).' km</p>
                </li>
            </a>
        </div>';


    }
 }

