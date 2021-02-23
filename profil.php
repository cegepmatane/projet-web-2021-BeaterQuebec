
<a style="float:right;" class="boutonThemeMenu" href="traitement-deconnection.php">Se déconnecter</a>
<header><h2>Profil</h2></header>
<section id="espace-membre">
    <p>Bienvenue, <?php echo $_SESSION['pseudonyme']; ?>!</p>
    <form action="traitement-membre-info.php" method="post" enctype="multipart/form-data">
        
        <div class="champs">
            <label for="pseudonyme">Pseudonyme *</label>
            <input type="text" name="pseudonyme" id="pseudonyme" value=<?php echo "\"".$_SESSION['pseudonyme']."\""; ?> required/>			
        </div>
        <div class="champs">
            <label for="email">Addesse courriel *</label>
            <input type="email" name="email" id="email" value=<?php echo "\"".$_SESSION['email']."\""; ?> required/>			
        </div>
        <div class="champs">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value=<?php echo "\"".$_SESSION['nom']."\""; ?>/>			
        </div>
        
        <div class="champs">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom" value=<?php echo "\"".$_SESSION['prenom']."\""; ?>/>			
        </div>
        <input type="submit" value="Modifier vos informations">
    </form>

    <form action="traitement-membre-mdp.php" method="post" enctype="multipart/form-data">
        <div class="champs">
            <label for="ancienMotDePasse">Ancien mot de passe *</label>
            <input type="password" name="ancienMotDePasse" id="ancienMotDePasse" required/>			
        </div>
        
        <div class="champs">
            <label for="confirmationMotDePasse">Nouveau mot de passe *</label>
            <input type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" required/>			
        </div>
        <input type="submit" value="Modifier votre mot de passe">
    </form>
    <h1>Historique d'achat</h1>
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