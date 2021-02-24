<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";


$id = filter_input(INPUT_GET, 'voiture', FILTER_VALIDATE_INT);
$voiture = VoitureDAO::lireVoiture($id);
if ($voiture->vendu)
{
	echo '<script type="text/javascript">'; 
    echo 'window.location.href = "liste-voiture.php";';
    echo '</script>';
}

include "entete.php";
include "getVisiteurInfos.php";
?>

<header><h2>Détails de la voiture</h2></header>
<br>
<div class="voiture">
    <?php 
        if(empty(formater($voiture->image))){echo "<img src='images/no-image-icon-0.jpg' alt='Miniature' class='image'></img>";}else{echo "<img src='images/".formater($voiture->image)."' alt='Miniature' class='image'></img>";} 
    ?>
	<br>
	<h3 id="produitNom" class="textDetailVoiture"><?= formater($voiture->marque); ?> <?= formater($voiture->modele); ?></h3>
	<br>
	<p class="textDetailVoiture">Année : <?= formater($voiture->annee); ?></p>
	<br>
	<p class="textDetailVoiture">Prix : <span style="color:#37A864;"$>$<?= formater($voiture->prix); ?></span></p>
    <br>
	<p class="textDetailVoiture">Kilométrages : <?= formater($voiture->kilometrages); ?> km</p>
	<br>
    <?php 
        if(empty(formater($voiture->description))){echo "<p class='textDetailVoiture'>Description : Aucune description du véhicule!</p>";}else{echo "<p class='textDetailVoiture'>Description du véhicule : ".formater($voiture->description)."</p>";} 
    ?>
    <p style="opacity: 0%;" id="prixProduit"><?= formater($voiture->prix); ?></p>
	<?php
	if (!empty($_SESSION)){
		
	require "stripe/config.php";
    include "stripe/index.php";
}

?>
	

<?php include "pied-page.php"?>