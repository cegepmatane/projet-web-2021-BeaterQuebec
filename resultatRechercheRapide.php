<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$filtresRecherche = [];

$filtresRecherche['recherche'] = FILTER_SANITIZE_ENCODED;
  
$arrayRecherche = filter_input_array(INPUT_POST, $filtresRecherche);

$textRecherche = implode($arrayRecherche);

$listResultatRecherche = VoitureDAO::lireRechercheRapide($textRecherche);
?>

<?php include "entete.php"?>
<header><h2>Résultat de la recherche</h2></header>

<div class="listeVoitureContenant">
    <ul class="listeVoiture">

<?php
    foreach($listResultatRecherche as $resultat)
    {
?>
        
        <div class="itemListeVoiture">
            <a class="lienListeVoiture" href="voiture.php?id=<?= $resultat["id"];?>">
                <li class="voitureListeVoiture">
                    <?php 
                        if(empty($resultat["image"])){echo "<img src='images/no-image-icon-0.jpg' alt='Miniature' class='imageListeVoiture'></img>";}else{echo "<img src='images/".$resultat['image']."' alt='Miniature' class='imageListeVoiture'></img>";} 
                    ?>
                    <h3><?= $resultat["marque"]; ?> <?= $resultat["modele"]; ?></h3>
                    <br>
                    <p class="descriptionListeVoiture">Prix : <span style="color:#37A864;"$>$<?= $resultat["prix"]; ?></span></p>
                    <br>
                    <p class="descriptionListeVoiture">Kilométrages : <?= $resultat["kilometrages"]; ?> km</p>
                </li>
            </a>
        </div>

<?php
    }
?>

    </ul>
</div>

<br><br>

<?php
    if(empty($resultat))
    {
?>

<br>
<p>Aucun résultat!</p>

<?php
    }
?>
        
<?php include "pied-page.php"?> 