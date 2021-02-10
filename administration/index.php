<?php
require "../configuration.php";
require CHEMIN_ACCESSEUR . "VisiteursDAO.php";

$statistiqueVisiteursParJour = VisiteursDAO::voirStatistiqueVisiteursParJour();
$statistiqueVisiteursParLangue = VisiteursDAO::voirStatistiqueVisiteursParLangue();

$dateTime = date('Y/m/d G:i');

?>

<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<meta charset="utf-8">
	<title>Les Beaters du Québec</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
	<header>
		<div class="header">
            <a href="index.php" class="logo">Panneau Administration</a>
        </div>
	</header>

	<section>
        
        <div class="grillePanneauAdmin">

            <a class="lienGrillePanneauAdministration" href="liste-voiture.php">
                <div style="grid-area: 1 / 1 / 2 / 2;">
                    <br>
                    <p class="texteVignettePanneauAdministration">
                        Gestion des Voitures
                    </p>
                    <br>
                    <img src="../images/gestion_voiture2.png" alt="Gestion des Voitures" style="width:100%; height:13rem;">
                </div>
            </a>

            <div style="grid-area: 1 / 2 / 2 / 3;">
                <div>
                    <p class="texteVignettePanneauAdministration">
                        <br>
                        Bienvenue sur le Panneau d'administration!
                        <br>
                        <br>
                        Date : <?php echo $dateTime; ?>
                    </p>
                </div>
            </div>

            <a class="lienGrillePanneauAdministration" href="visiteurs.php">
                <div style="grid-area: 1 / 3 / 2 / 4;">
                    <br>
                    <p class="texteVignettePanneauAdministration">
                        Statistiques des Visiteurs
                    </p>
                    <br>
                    <img src="../images/statistiques.png" alt="Statistiques" style="width:100%; height:13rem;">
                </div>
            </a>

            <a class="lienGrillePanneauAdministration" href="WIP.php">
                <div style="grid-area: 2 / 1 / 3 / 2;">
                    <br>
                    <p class="texteVignettePanneauAdministration">
                        Work In Progress
                    </p>
                    <br>
                    <img src="../images/work-in-progress-icon.png" alt="WIP" style="width:100%; height:13rem;">
                </div>
            </a>

            <div style="grid-area: 2 / 2 / 3 / 3;">
                <br>
                <p class="texteVignettePanneauAdministration">
                    <?php 
                        foreach($statistiqueVisiteursParJour as $statistiques){
                            switch ($statistiques['Journee']){
                                case 1:
                                    $pensee = "La beauté est dans les yeux de celui qui regarde. - Oscar Wilde";
                                break;
                                case 2:
                                    $pensee = "Le souvenir, c'est la présence invisible. - Victor Hugo";
                                break;
                                case 3:
                                    $pensee = "Le courage n'est pas l'absence de peur, mais la capacité de vaincre ce qui fait peur. - Nelson Mandela";
                                break;
                                case 4:
                                    $pensee = "La vie sans musique est tout simplement une erreur, une fatigue, un exil. - Friedrich Nietzsche";
                                break;
                                case 5:
                                    $pensee = "Un problème sans solution est un problème mal posé. - Albert Einstein";
                                break;
                                case 6:
                                    $pensee = "La musique est la langue des émotions. - Emmanuel Kant";
                                break;
                                case 7:
                                    $pensee = "Qui veut la paix prépare la guerre. - Jules César";
                                break;
                            }
                        } 
                    ?>
                    Citation de la journée : <br><br><?php echo $pensee; ?>
                </p>
            </div>

            <a class="lienGrillePanneauAdministration" href="visiteurs.php">
                <div style="grid-area: 2 / 3 / 3 / 4;">
                    <br>
                    <p class="texteVignettePanneauAdministration">
                        Statistiques des Visiteurs
                    </p>
                    <br>
                    <table class="tableauContenuVisiteur">
                        <tr>
                            <td>Langue</td>
                            <td>Nombre de Clics</td>
                            <td>Ip de l'utilisateur</td>
                        </tr>
                        <?php 	
                            $nbreRecord = 0;

                            foreach($statistiqueVisiteursParLangue as $statistique)
                            {
                                $nbreRecord++;
                                if ($nbreRecord >= 6)
                                    return;
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
                </div>
            </a>
            
        </div>

	</section>
    <footer><span id="signature">Copyright © 2021 Les Beater du Québec. All Rights Reserved.</span></footer>
</body>
</html>