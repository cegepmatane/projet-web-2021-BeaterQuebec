<?php
session_start();

require("langue.php");

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
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$listVoiture = VoitureDAO::listerVoiture();
?>

<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<meta charset="utf-8">
	<title><?php echo _("Les Beaters du Québec"); ?></title>
</head>
<body>
	<header>
        <div class="header">
            <a href="index.php?lang=<?php echo $urlLocale; ?>" class="logo"><?php echo _("Panneau Administration"); ?></a>
        </div>
        
        <h1 class="titrePrincipalePanneauAdmin"><?php echo _("Gestion des Voitures"); ?></h1>
	</header>

	<section id="contenu" style="">
	
		<a class="boutonPanneauAdministration" href="ajouter-voiture.php?lang=<?php echo $urlLocale; ?>"><?php echo _("Ajouter une Voiture"); ?></a>
        <br><br>
		<?php 	
            if (!empty($listVoiture)){
                foreach($listVoiture as $voiture)
                {
		?>
                    <div class="recordPanneauAdministration">
                        <?php echo formater($voiture->marque); ?> <?php echo formater($voiture->modele); ?>
                        <a class="lienPanneauAdministration" style="float: right; margin-left:1rem;" href="modifier-voiture.php?voiture=<?php echo $voiture->id; ?>&lang=<?php echo $urlLocale; ?>" title="">
                            <?php echo _("Modifier"); ?>
                        </a>
                        <a class="lienPanneauAdministration" style="float: right;" href="supprimer-voiture.php?voiture=<?php echo $voiture->id; ?>&lang=<?php echo $urlLocale; ?>" title="">
                            <?php echo _("Supprimer"); ?>
                        </a>
                    </div>		
		<?php 		
			 }
            }
		?>

	</section>
    <footer><span id="signature"><?php echo _("Copyright © 2021 Les Beaters du Québec. All Rights Reserved."); ?></span></footer>
</body>
</html>
