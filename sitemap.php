<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$listVoiture = VoitureDAO::listerVoiture();

// https://support.google.com/webmasters/answer/183668?hl=en
?>
<!--<?xml version="1.0" encoding="UTF-8"?>-->
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 

    <url>
        <loc>http://localhost/ProjetWeb/index.php</loc>
        <lastmod>2021-01-18</lastmod>
    </url>
    <url>
        <loc>http://localhost/ProjetWeb/liste-voiture.php</loc>
        <lastmod>2021-01-18</lastmod>
    </url>
    <url>
        <loc>http://localhost/ProjetWeb/membre.php</loc>
        <lastmod>2021-01-18</lastmod>
    </url>
    <url>
        <loc>http://localhost/ProjetWeb/inscription.php</loc>
        <lastmod>2021-01-18</lastmod>
    </url>
    <?php 
        if (!empty($listVoiture)){
            foreach($listVoiture as $voiture)
            {
    ?>
<url>
        <loc>http://localhost/ProjetWeb/voiture.php?voiture=<?=$voiture->id?></loc>
        <lastmod>2021-01-18</lastmod>
    </url>  
    <?php 
            }
        }
    ?>

</urlset> 