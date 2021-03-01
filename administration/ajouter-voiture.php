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
        
		<nav></nav>
	</header>
	
	<section id="contenu">
		<header><h2><?php echo _("Ajouter une voiture"); ?></h2></header>
		
		<form action="traitement-ajouter-voiture.php" method="post" enctype="multipart/form-data">
		
			<div class="champs">
				<label for="marque"><?php echo _("Marque"); ?> *</label>
				<input type="text" name="marque" id="marque" required/>			
			</div>
		
			<div class="champs">
				<label for="modele"><?php echo _("Modèle"); ?> *</label>
				<input type="text" name="modele" id="modele" required/>			
			</div>
			
			<div class="champs">
				<label for="annee"><?php echo _("Année de sortie"); ?> *</label>
				<input type="text" name="annee" id="annee" required/>			
			</div>	
			
			<div class="champs">
				<label for="description"><?php echo _("Description"); ?></label>
				<textarea name="description" id="description"></textarea>			
			</div>	
            
            <div class="champs">
				<label for="prix"><?php echo _("Prix"); ?> *</label>
				<input type="text" name="prix" id="prix" required/>			
			</div>	
            
            <div class="champs">
				<label for="kilometrages"><?php echo _("Kilométrages"); ?> *</label>
				<input type="text" name="kilometrages" id="kilometrages" required/>			
			</div>	
			
			<div class="champs">
				<label for="image"><?php echo _("Image"); ?></label>
				<input type="file" name="image" id="image"/>			
			</div>
			
			<input type="submit" value="<?php echo _("Enregistrer"); ?>">
		</form>
	
	</section>
	
	<footer><span id="signature"><?php echo _("Copyright © 2021 Les Beaters du Québec. All Rights Reserved."); ?></span></footer>
</body>
</html>