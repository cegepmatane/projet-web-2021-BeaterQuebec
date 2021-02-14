<!doctype html> 
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="utf-8">
  <title>Les Beaters du Québec</title>
</head>
<body>
	<header>
        
    <?php session_start();?>
        
    <div class="header">
      <a href="index.php" class="logo">Les Beaters du Québec</a>
      <div class="header-right">
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "index.php"){echo 'class="active"';}?> href="index.php">Acceuil</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "a-propos.php"){echo 'class="active"';}?> href="a-propos.php">À propos</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "liste-voiture.php"){echo 'class="active"';}?> href="liste-voiture.php">Voir les offres</a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "membre.php"){echo 'class="active"';}?> href="membre.php">Membre</a>
        <?php 
          $page = basename($_SERVER["PHP_SELF"]); 
          
          if (!empty($_SESSION)){ 
              if ($_SESSION["admin"]){
                  echo '<a href="administration/index.php">Panneau Admin</a>';
              }
          }
        ?>
        <form action="resultatRechercheRapide.php" class="formRechercheRapide" method="post" enctype="multipart/form-data">
            <input class="inputRechercheRapide" type="text" name="recherche" id="recherche" placeholder="Rechercher.."/>	
        </form>
      </div>
    </div>
        
  </header>
  <section id="contenu">