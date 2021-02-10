<!doctype html> 
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="utf-8">
  <title>Les Beaters du Québec</title>
</head>
<body>
	<header>
        
    <div class="header">
      <a href="index.php" class="logo">Les Beaters du Québec</a>
      <div class="header-right">
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "index.php"){echo 'class="active"';}?> href="index.php">Acceuil</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "mission.php"){echo 'class="active"';}?> href="mission.php">Mission</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "liste-voiture.php"){echo 'class="active"';}?> href="liste-voiture.php">Voir les offres</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "membre.php"){echo 'class="active"';}?> href="membre.php">Membre</a>
        <form action="resultatRechercheRapide.php" class="formRechercheRapide" method="post" enctype="multipart/form-data">
            <input class="inputRechercheRapide" type="text" name="recherche" id="recherche" placeholder="Rechercher.."/>	
        </form>
      </div>
    </div>
        
  </header>
  <section id="contenu">