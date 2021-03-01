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

require "../configuration.php";
require CHEMIN_ACCESSEUR . "VisiteursDAO.php";

$statistiqueVisiteursParJour = VisiteursDAO::voirStatistiqueVisiteursParJour();
$statistiqueVisiteursParLangue = VisiteursDAO::voirStatistiqueVisiteursParLangue();

$nbreJourDimanche = 0;
$nbreJourLundi = 0;
$nbreJourMardi = 0;
$nbreJourMercredi = 0;
$nbreJourJeudi = 0;
$nbreJourVendredi = 0;
$nbreJourSamedi = 0;
?> 

<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<meta charset="utf-8">
    <title><?php echo _("Les Beaters du Québec"); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
	<header>
        <div class="header">
        <a href="index.php?lang=<?php echo $urlLocale; ?>" class="logo"><?php echo _("Panneau Administration"); ?></a>
        </div>
        
        <h1 class="titrePrincipalePanneauAdmin"><?php echo _("Statistiques des Visiteurs"); ?></h1>
	</header>

	<section id="contenu">

        <table class="tableauContenuVisiteur">
            <tr>
                <td><?php echo _("Journée"); ?></td>
                <td><?php echo _("Nombre de Clics"); ?></td>
                <td><?php echo _("Ip de l'utilisateur"); ?></td>
            </tr>
            <?php 	
                foreach($statistiqueVisiteursParJour as $statistiques)
                {
                    switch($statistiques['Journee'])
                    {
                        case 1:
                            $jour = "Dimanche";
                            $nbreJourDimanche++;
                        Break;
                        case 2:
                            $jour = "Lundi";
                            $nbreJourLundi++;
                        Break;
                        case 3:
                            $jour = "Mardi";
                            $nbreJourMardi++;
                        Break;
                        case 4:
                            $jour = "Mercredi";
                            $nbreJourMercredi++;
                        Break;
                        case 5:
                            $jour = "Jeudi";
                            $nbreJourJeudi++;
                        Break;
                        case 6:
                            $jour = "Vendredi";
                            $nbreJourVendredi++;
                        Break;
                        case 7:
                            $jour = "Samedi";
                            $nbreJourSamedi++;
                        Break;
                    }
            ?>
            <tr>
                <td><?php echo $jour, " le ", $statistiques['Annee'], "-", $statistiques['Mois'], "-", $statistiques['Jour']?></td>
                <td><?php echo $statistiques['Clics']; ?></td>
                <td><?php echo $statistiques['User_ip']; ?></td>
            </tr>
            <?php 		
                }
            ?>
        </table>

        <table class="tableauContenuVisiteur">
            <tr>
                <td><?php echo _("Langue"); ?></td>
                <td><?php echo _("Nombre de Clics"); ?></td>
                <td><?php echo _("Ip de l'utilisateur"); ?></td>
            </tr>
            <?php 	
                foreach($statistiqueVisiteursParLangue as $statistique)
                {
            ?>
            <tr>
                <td><?php echo $statistique['Langue']; ?></td>
                <td><?php echo $statistique['Clics']; ?></td>
                <td><?php echo $statistique['User_ip']; ?></td>
            </tr>
            <?php 		
                }
            ?>
        </table>

        <div class="chart-container" style="position: relative; height:30vh; width:60vw; margin-top:1em; margin-bottom:25rem;">
            <canvas id="graphique"></canvas>
        </div>

        <script>
            var donnees = [<?php echo $nbreJourDimanche; ?>, <?php echo $nbreJourLundi; ?>, <?php echo $nbreJourMardi; ?>, <?php echo $nbreJourMercredi; ?>, <?php echo $nbreJourJeudi; ?>, <?php echo $nbreJourVendredi; ?>, <?php echo $nbreJourSamedi; ?>]; // Tableau des données
            var etiquettes = ['<?php echo _("Dimanche"); ?>', '<?php echo _("Lundi"); ?>', '<?php echo _("Mardi"); ?>', '<?php echo _("Mercredi"); ?>', '<?php echo _("Jeudi"); ?>', '<?php echo _("Vendredi"); ?>', '<?php echo _("Samedi"); ?>'] // Tableau des étiquettes

            var cible = document.getElementById('graphique').getContext('2d');
            var graphiqueLigne = new Chart(cible, {
                type: 'line',

                data: {
                    labels: etiquettes,
                    datasets: [{
                        label: '<?php echo _("Visite selon les Jours"); ?>',
                        backgroundColor: '#1e90ff',
                        borderColor: 'black',
                        data: donnees
                    }]
                },

                options: {}
            });
        </script>

    </section>
    <footer><span id="signature"><?php echo _("Copyright © 2021 Les Beaters du Québec. All Rights Reserved."); ?></span></footer>
</body>
</html>