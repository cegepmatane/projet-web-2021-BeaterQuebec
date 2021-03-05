<script src="js/erreurProfil.js"></script>
<a style="float:right;" class="boutonThemeMenu" href="traitement-deconnection.php?lang=<?php echo $urlLocale; ?>"><?php echo _("Se déconnecter"); ?></a>
<header><h2><?php echo _("Profil"); ?></h2></header>
<section id="espace-membre">
    <p><?php echo _("Bienvenue"); ?>, <?php echo $_SESSION['pseudonyme']; ?>!</p>
    
    <p id="txtErreur"></p>
    
    <form action="traitement-membre-info.php?lang=<?php echo $urlLocale; ?>" method="post" enctype="multipart/form-data">
        
        <div class="champs">
            <label for="pseudonyme"><?php echo _("Pseudonyme"); ?> *</label>
            <input type="text" name="pseudonyme" id="pseudonyme" onkeyup="showErreurPseudo(this.value, '<?php echo $_SESSION['pseudonyme']; ?>')" value=<?php echo "\"".$_SESSION['pseudonyme']."\""; ?> required/>			
        </div>
        <div class="champs">
            <label for="email"><?php echo _("Addesse courriel"); ?> *</label>
            <input type="email" name="email" id="email" onkeyup="showErreurCourriel(this.value, '<?php echo $_SESSION['email']; ?>')" value=<?php echo "\"".$_SESSION['email']."\""; ?> required/>			
        </div>
        <div class="champs">
            <label for="nom"><?php echo _("Nom"); ?></label>
            <input type="text" name="nom" id="nom" value=<?php echo "\"".$_SESSION['nom']."\""; ?>/>			
        </div>
        
        <div class="champs">
            <label for="prenom"><?php echo _("Prenom"); ?></label>
            <input type="text" name="prenom" id="prenom" value=<?php echo "\"".$_SESSION['prenom']."\""; ?>/>			
        </div>
        <input id="inputModifierInfos" type="submit" value="<?php echo _("Modifier vos informations"); ?>">
    </form>

    <form action="traitement-membre-mdp.php?lang=<?php echo $urlLocale; ?>" method="post" enctype="multipart/form-data">
        <div class="champs">
            <label for="ancienMotDePasse"><?php echo _("Ancien mot de passe"); ?> *</label>
            <input type="password" name="ancienMotDePasse" id="ancienMotDePasse" required/>			
        </div>
        
        <div class="champs">
            <label for="confirmationMotDePasse"><?php echo _("Nouveau mot de passe"); ?> *</label>
            <input type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" required/>			
        </div>
        <input type="submit" value="<?php echo _("Modifier votre mot de passe"); ?>">
    </form>
    
    <h1><?php echo _("Historique d'achat"); ?></h1>
    <div style="margin-bottom: 5rem;">
    <?php
        require CHEMIN_ACCESSEUR . "VoitureDAO.php";

        $vendus = VoitureDAO::lireVendu($_SESSION['id']);

        if($vendus)
        {
            foreach($vendus as $voitures)
            {
                $voiture = VoitureDAO::lireVoitureVendu($voitures['fk_voiture']);?>
                
                <div class="recordPanneauAdministration">
                        <?php echo formater($voiture->marque); ?> <?php echo formater($voiture->modele); ?> <span style="color:#37A864;"$>$<?php echo formater($voiture->prix); ?></span>
                        
                </div>		
                
                
                
                 <?php
            }
        }


?>
</div>



</section> 