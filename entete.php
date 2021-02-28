<?php

if(!isset($_GET['lang']))
{
  $locale = 'fr_CA.utf8';
  $urlLocale = 'fr';
}else if ($_GET['lang'] == 'en' ){
  $locale = 'en_US.utf8';
  $urlLocale = 'en';
}else{
  $locale = 'fr_CA.utf8';
  $urlLocale = 'fr';
}
$domain = 'messages';
setlocale(LC_ALL, $locale);
putenv("LC_ALL=$locale");

bindtextdomain($domain, "./locale");
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);

?>
<!doctype html> 
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta charset="utf-8">
  <title><?php echo _("Les Beaters du Québec"); ?></title>
</head>
<body>
	<header>
        
    <?php session_start();?>
        
    <div class="header">
      <a href="index.php?lang=<?php echo $urlLocale ?>" class="logo"><?php echo _("Les Beaters du Québec"); ?></a>
      <div class="header-right">
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "index.php"){echo 'class="active"';}?> href="index.php?lang=<?php echo $urlLocale ?>"><?php echo _("Acceuil"); ?></a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "a-propos.php"){echo 'class="active"';}?> href="a-propos.php?lang=<?php echo $urlLocale ?>"><?php echo _("À propos"); ?></a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "liste-voiture.php"){echo 'class="active"';}?> href="liste-voiture.php?lang=<?php echo $urlLocale ?>"><?php echo _("Voir les offres"); ?></a>
        <a <?php $page = basename($_SERVER['PHP_SELF']); if ($page == "membre.php"){echo 'class="active"';}?> href="membre.php?lang=<?php echo $urlLocale ?>"><?php echo _("Membre"); ?></a>
        <?php 
          $page = basename($_SERVER["PHP_SELF"]); 
          
          if (!empty($_SESSION)){ 
              if ($_SESSION["admin"]){
                  echo '<a href="administration/index.php">';
                  echo _('Panneau Admin');
                  echo'</a>';
              }
          }
        ?>
        <form action="resultatRechercheRapide.php" class="formRechercheRapide" method="post" enctype="multipart/form-data">
            <input class="inputRechercheRapide" type="text" name="recherche" id="recherche" placeholder="<?php echo _("Rechercher.."); ?>"/>	
        </form>
      </div>
    </div>
        
  </header>
  <section id="contenu">