<header><h2><?php echo _('Connexion'); ?></h2></header>

<section id="authentification">
    <form action="membre.php?lang=<?php echo $urlLocale; ?>" method="POST">
        <div>
            <label><?php echo _('Pseudonyme'); ?></label>
            <input type="text" name="pseudonyme"/>
        </div>
        <div>
            <label><?php echo _('Mot de passe'); ?></label>
            <input type="password" name="motDePasse"/>
        </div>
        <input type="submit" name="action-connexion" value="<?php echo _('Connexion'); ?>"/>
        <br></br>
        <a class="boutonThemeMenu" href="inscription.php" id="btnInscription"><?php echo _('Pas de compte? Inscrivez-vous ici!'); ?></a>
    </form>
</section>