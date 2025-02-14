<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";

$listVoiture = VoitureDAO::listerVoiture();
?>
<!--<?xml version="1.0" encoding="UTF-8"?>-->
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	>

    <channel>
        <title>Liste des meilleures Voiture de rally de Groupe B</title>
        <atom:link href="http://localhost/journal/feed/" rel="self" type="application/rss+xml" />
        <link>http://localhost/ProjetWeb/</link>
        <description>Les Beaters du Québec</description>
        <lastBuildDate>Mon, 18 Jan 2021 14:27:41 +0000</lastBuildDate>
        <language>fr-CA</language>
        <sy:updatePeriod> hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
        <generator>Programmation manuelle</generator>

    <?php 
        if (!empty($listVoiture)){
            foreach($listVoiture as $voiture)
            {
	?>

        <item>
            <title><?=formater($voiture->marque)?></title>
            <link>http://localhost/ProjetWeb/voiture.php?id=<?=$voiture->id?></link>
            <pubDate>Mon, 18 Mar 2019 14:27:41 +0000</pubDate>
            <category><![CDATA[Voiture]]></category>
            <guid isPermaLink="false">http://localhost/ProjetWeb/voiture.php?voiture=<?=$voiture->id?></guid>
            <description><![CDATA[<?=formater($voiture->modele); ?>]]></description>
            <content:encoded><![CDATA[<?=formater($voiture->annee); ?>]]></content:encoded>
        </item>

	<?php
	       }
        }
    ?>
							
	</channel>
</rss>