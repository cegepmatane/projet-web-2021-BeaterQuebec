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
?>

<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<meta charset="utf-8">
	<title>Les Beater du Québec</title>
</head>
<body>
	<header>
        <div class="header">
            <a href="index.php" class="logo">Panneau Administration</a>
        </div>
        
		<nav></nav>
	</header>
	
	<section id="contenu">
		<header><h2>Ajouter une voiture</h2></header>
		
		<form action="traitement-ajouter-voiture.php" method="post" enctype="multipart/form-data">
		
			<div class="champs">
				<label for="marque">Marque *</label>
				<input type="text" name="marque" id="marque" required/>			
			</div>
		
			<div class="champs">
				<label for="modele">Modèle *</label>
				<input type="text" name="modele" id="modele" required/>			
			</div>
			
			<div class="champs">
				<label for="annee">Année de sortie *</label>
				<input type="text" name="annee" id="annee" required/>			
			</div>	
			
			<div class="champs">
				<label for="description">Description</label>
				<textarea name="description" id="description"></textarea>			
			</div>	
            
            <div class="champs">
				<label for="prix">Prix *</label>
				<input type="text" name="prix" id="prix" required/>			
			</div>	
            
            <div class="champs">
				<label for="kilometrages">Kilométrages *</label>
				<input type="text" name="kilometrages" id="kilometrages" required/>			
			</div>	
			
			<div class="champs">
				<label for="image">Image</label>
				<input type="file" name="image" id="image"/>			
			</div>
			
			<input type="submit" value="Enregistrer">
		</form>
	
	</section>
	
	<footer><span id="signature">Copyright © 2021 Les Beater du Québec. All Rights Reserved.</span></footer>
</body>
</html>