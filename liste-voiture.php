<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$listVoiture = VoitureDAO::listerVoiture();

include "entete.php";
include "getVisiteurInfos.php";
?>	

<!--<a class="boutonThemeMenu" href="test-excel.php" download="voitures.xlsx">Exportation vers un fichier Excel</a>-->

<div class="listeVoitureContenant">

<form class="formRechercheAvance" action="resultatRechercheAvance.php?lang=<?php echo $urlLocale; ?>" method="post" enctype="multipart/form-data">
		
    <div class="champs">
        <label for="marque"><?php echo _('Marque'); ?></label>
        <input class="inputRechercheAvance" type="text" name="marque" id="marque"/>			
    </div>

    <div class="champs">
        <label for="modele"><?php echo _('Modèle'); ?></label>
        <input class="inputRechercheAvance" type="text" name="modele" id="modele"/>			
    </div>
    
    <div class="champs">
        <label for="annee"><?php echo _('Année de sortie'); ?></label>
        <select class="selectRechercheAvance" name= "annee">
            <option value="1970-et-moin"><?php echo _('1970 et moin'); ?></option>
            <option value="1970-a-1979">1970 - 1979</option>
            <option value="1980-a-1989">1980 - 1989</option>
            <option value="1990-a-1999">1990 - 1999</option>
            <option value="2000-a-2009">2000 - 2009</option>
            <option value="2009-a-2019">2009 - 2019</option>
            <option value="2019-et-plus"><?php echo _('2019 et plus'); ?></option>
        </select>
    </div>		

    <div class="champs">
        <label for="prix"><?php echo _('Prix maximum'); ?></label>
        <input class="inputRechercheAvance" type="text" name="prix" id="prix"/>			
    </div>
    
    <div class="champs">
        <label for="prix"><?php echo _('Kilométrages maximum'); ?></label>
        <input class="inputRechercheAvance" type="text" name="kilometrages" id="kilometrages"/>			
    </div>
    
    <input class="inputSubmitRechercheAvance" type="submit" value="<?php echo _('Rechercher'); ?>">

</form>

    <ul class="listeVoiture">

<?php
    if (!empty($listVoiture)){
        foreach($listVoiture as $voiture)
        {
?>
        
            <div class="itemListeVoiture">
                <a class="lienListeVoiture" href="voiture.php?voiture=<?= $voiture->id;?>&lang=<?php echo $urlLocale;?>">
                    <li class="voitureListeVoiture">
                        <?php 
                            if(empty(formater($voiture->image))){echo "<img src='images/no-image-icon-0.jpg' alt='Miniature' class='imageListeVoiture'></img>";}else{echo "<img src='images/".formater($voiture->image)."' alt='Miniature' class='imageListeVoiture'></img>";} 
                        ?>
                        <h3><?= formater($voiture->marque); ?> <?= formater($voiture->modele); ?></h3>
                        <br>
                        <p class="descriptionListeVoiture"><?php echo _('Prix : '); ?><span style="color:#37A864;"$>$<?= formater($voiture->prix); ?></span></p>
                        <br>
                        <p class="descriptionListeVoiture"><?php echo _('Kilométrages : '); ?><?= formater($voiture->kilometrages); ?> km</p>
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

<?php include "pied-page.php"?>