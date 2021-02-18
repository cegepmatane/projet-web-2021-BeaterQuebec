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
require CHEMIN_ACCESSEUR . "MembreDAO.php";

$pseudonyme = $_GET['pseudonyme'];
$membre = MembreDAO::lireMembreParPseudonyme($pseudonyme);
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
		<header><h2>Modifier un membre</h2></header>
		
		<form action="traitement-modifier-membre-info.php?pseudonyme=<?php echo $membre->pseudonyme; ?>&email=<?php echo $membre->email; ?>" method="post" enctype="multipart/form-data">
        
			<div class="champs">
				<label for="pseudonyme">Pseudonyme *</label>
				<input type="text" name="pseudonyme" id="pseudonyme" value="<?php echo $membre->pseudonyme ?>" required/>			
			</div>
			<div class="champs">
				<label for="email">Addesse courriel *</label>
				<input type="email" name="email" id="email" value="<?php echo $membre->email ?>" required/>			
			</div>
			<div class="champs">
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" value="<?php echo $membre->nom ?>"/>			
			</div>
			
			<div class="champs">
				<label for="prenom">Prenom</label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $membre->prenom ?>"/>			
			</div>
			<input type="submit" value="Modifier les informations">
    	</form>
    <form action="traitement-modifier-membre-mdp.php?pseudonyme=<?php echo $membre->pseudonyme; ?>" method="post" enctype="multipart/form-data">
        <div class="champs">
            <label for="motDePasse">Mot de passe *</label>
            <input type="password" name="motDePasse" id="motDePasse" required/>			
        </div>
        <input type="submit" value="Modifier le mot de passe">
    </form>
		</form>
	
	</section>
	
	<footer><span id="signature">Copyright © 2021 Les Beater du Québec. All Rights Reserved.</span></footer>
</body>
</html>