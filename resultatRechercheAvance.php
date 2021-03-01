<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$filtresMarque = [];

$filtresMarque['marque'] = FILTER_SANITIZE_ENCODED;
  
$arrayMarque = filter_input_array(INPUT_POST, $filtresMarque);

if(isset($arrayMarque))
{
    $textMarque = implode($arrayMarque);
}

$filtresModele = [];

$filtresModele['modele'] = FILTER_SANITIZE_ENCODED;
  
$arrayModele = filter_input_array(INPUT_POST, $filtresModele);

if(isset($arrayModele))
{
    $textModele = implode($arrayModele);
}

$filtresPrix = [];

$filtresPrix['prix'] = FILTER_SANITIZE_ENCODED;
  
$arrayPrix = filter_input_array(INPUT_POST, $filtresPrix);

if(isset($arrayPrix))
{
    $prixMax = implode($arrayPrix);
}
$filtresKilometrages = [];

$filtresKilometrages['kilometrages'] = FILTER_SANITIZE_ENCODED;
  
$arrayKilometrages = filter_input_array(INPUT_POST, $filtresKilometrages);

if(isset($arrayKilometrages))
{
    $kilometragesMax = implode($arrayKilometrages);
}
$filtresAnnee = [];

$filtresAnnee['annee'] = FILTER_SANITIZE_ENCODED;
  
$arrayAnnee = filter_input_array(INPUT_POST, $filtresAnnee);

if(isset($arrayAnnee))
{
    foreach($arrayAnnee as $annee) 
    {
        switch($annee)
        {
        case "1970-et-moin" :
            $min = 1;
            $max = 1970;
        break;
        case "1970-a-1979" :
            $min = 1970;
            $max = 1979;
        break;
        case "1980-a-1989" :
            $min = 1980;
            $max = 1989;
        break;
        case "1990-a-1999" :
            $min = 1990;
            $max = 1999;
        break;
        case "2000-a-2009" :
            $min = 2000;
            $max = 2009;
        break;
        case "2009-a-2019" :
            $min = 2009;
            $max = 2019;
        break;
        case "2019-et-plus" :
            $min = 2019;
            $max = 2100;
        break;
        }
    }
    $listResultatRecherche = VoitureDAO::lireRechercheAvance($textMarque, $textModele, $min, $max, $prixMax, $kilometragesMax);
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