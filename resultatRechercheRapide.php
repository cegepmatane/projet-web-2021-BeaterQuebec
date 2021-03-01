<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$filtresRecherche = [];

$filtresRecherche['recherche'] = FILTER_SANITIZE_ENCODED;
  
$arrayRecherche = filter_input_array(INPUT_POST, $filtresRecherche);

if(isset($arrayRecherche)){
    $textRecherche = implode($arrayRecherche);
    $listResultatRecherche = VoitureDAO::lireRechercheRapide($textRecherche);
}

?>

<?php include "entete.php"?>
<header><h2><?php echo _("Résultat de la recherche"); ?></h2></header>

<div class="listeVoitureContenant">
    <ul class="listeVoiture">

<?php
    if (!empty($listResultatRecherche)){
        foreach($listResultatRecherche as $resultat)
        {
?>
        
            <div class="itemListeVoiture">
                <a class="lienListeVoiture" href="voiture.php?voiture=<?= $resultat->id;?>&lang=<?php echo $urlLocale; ?>">
                    <li class="voitureListeVoiture">
                        <?php 
                            if(empty(formater($resultat->image))){echo "<img src='images/no-image-icon-0.jpg' alt='Miniature' class='imageListeVoiture'></img>";}else{echo "<img src='images/".formater($resultat->image)."' alt='Miniature' class='imageListeVoiture'></img>";} 
                        ?>
                        <h3><?= formater($resultat->marque); ?> <?= formater($resultat->modele); ?></h3>
                        <br>
                        <p class="descriptionListeVoiture"><?php echo _("Prix : "); ?><span style="color:#37A864;"$>$<?= formater($resultat->prix); ?></span></p>
                        <br>
                        <p class="descriptionListeVoiture"><?php echo _("Kilométrages : "); ?><?= formater($resultat->kilometrages); ?> km</p>
                    </li>
                </a>
            </div>

<?php
        }
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
<p><?php echo _("Aucun résultat!"); ?></p>

<?php
    }
?>
        
<?php include "pied-page.php"?> 