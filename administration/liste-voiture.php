<?php
require "../configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$listVoiture = VoitureDAO::listerVoiture();
?>

<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<meta charset="utf-8">
	<title>Les Beaters du Québec</title>
</head>
<body>
	<header>
        <div class="header">
            <a href="index.php" class="logo">Panneau Administration</a>
        </div>
        
        <h1 class="titrePrincipalePanneauAdmin">Gestion des Voitures</h1>
	</header>

	<section id="contenu" style="">
	
		<a class="boutonPanneauAdministration" href="ajouter-voiture.html">Ajouter une Voiture</a>
        <br><br>
		<?php 	
			foreach($listVoiture as $voiture)
			{
		?>
				<div class="recordPanneauAdministration">
					<?php echo formater($voiture->marque); ?> <?php echo formater($voiture->modele); ?>
					<a class="lienPanneauAdministration" style="float: right; margin-left:1rem;" href="modifier-voiture.php?voiture=<?php echo $voiture->id; ?>" title="">
						Modifier
					</a>
					<a class="lienPanneauAdministration" style="float: right;" href="supprimer-voiture.php?voiture=<?php echo $voiture->id; ?>" title="">
						Supprimer
					</a>
				</div>		
		<?php 		
			}
		?>

	</section>
    <footer><span id="signature">Copyright © 2021 Les Beater du Québec. All Rights Reserved.</span></footer>
</body>
</html>
