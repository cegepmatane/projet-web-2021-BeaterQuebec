<?php
session_start();

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

$noVoiture = $_GET['voiture'];
$voiture = VoitureDAO::lireVoiture($noVoiture);
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
		<nav></nav>
	</header>
	
	<section id="contenu">
		<header><h2>Modifier une voiture</h2></header>
		
		<form action="traitement-modifier-voiture.php" method="post" enctype="multipart/form-data">
		
			<div class="champs">
				<label for="marque">Marque *</label>
				<input type="text" name="marque" id="marque" value="<?php echo formater($voiture->marque)?>" required/>			
			</div>
		
			<div class="champs">
				<label for="modele">Modèle *</label>
				<input type="text" name="modele" id="modele" value="<?php echo formater($voiture->modele)?>" required/>			
			</div>
			
			<div class="champs">
				<label for="annee">Année de sortie *</label>
				<input type="text" name="annee" id="annee" value="<?php echo formater($voiture->annee)?>" required/>			
			</div>	
			
			<div class="champs">
				<label for="description">Description</label>
				<textarea name="description" id="description"><?=formater($voiture->description)?></textarea>			
			</div>	
    
            <div class="champs">
				<label for="prix">Prix *</label>
				<input type="text" name="prix" id="prix" value="<?php echo formater($voiture->prix)?>" required/>			
			</div>	
            
            <div class="champs">
				<label for="kilometrages">Kilométrages *</label>
				<input type="text" name="kilometrages" id="kilometrages" value="<?php echo formater($voiture->kilometrages)?>" required/>			
			</div>	
			
			<div class="champs">
				<label for="image">Image</label>
				<input type="file" name="image" id="image"/>			
			</div>
			
			<input type="submit" value="Enregistrer">
			<input type="hidden" name="id" value="<?=$voiture->id?>"/>
		</form>
	
	</section>
	
	<footer><span id="signature">Copyright © 2021 Les Beater du Québec. All Rights Reserved.</span></footer>
</body>
</html>