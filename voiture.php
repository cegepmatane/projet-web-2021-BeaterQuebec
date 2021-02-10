<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$voiture = VoitureDAO::lireVoiture($id);

include "entete.php";
include "getVisiteurInfos.php";
?>

<header><h2>Détails de la voiture</h2></header>
<br>
<div class="voiture">
    <?php 
        if(empty($voiture["image"])){echo "<img src='images/no-image-icon-0.jpg' alt='Miniature' class='image'></img>";}else{echo "<img src='images/".$voiture['image']."' alt='Miniature' class='image'></img>";} 
    ?>
	<br>
	<h3 class="textDetailVoiture"><?= $voiture["marque"]; ?> <?= $voiture["modele"]; ?></h3>
	<br>
	<p class="textDetailVoiture">Année : <?= $voiture["annee"]; ?></p>
	<br>
	<p class="textDetailVoiture">Prix : <span style="color:#37A864;"$>$<?= $voiture["prix"]; ?></span></p>
    <br>
	<p class="textDetailVoiture">Kilométrages : <?= $voiture["kilometrages"]; ?> km</p>
	<br>
    <?php 
        if(empty($voiture["description"])){echo "<p class='description'>Description : Aucune description du véhicule!</p>";}else{echo "<p class='textDetailVoiture'>Description du véhicule : ".$voiture['description']."</p>";} 
    ?>
	<p style="padding-bottom: 15rem;"></p>
</div>

<?php include "pied-page.php"?>