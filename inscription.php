<?php include "entete.php"?>
	
<header><h2><?php echo _("Inscription"); ?></h2></header>

<section id="inscription">
	<form action="traitement-inscription.php?lang=<?php echo $urlLocale; ?>" method="post" enctype="multipart/form-data">
        
		<div class="champs">
			<label for="pseudonyme"><?php echo _("Pseudonyme"); ?> *</label>
			<input type="text" name="pseudonyme" id="pseudonyme" required/>			
		</div>
        
        <div class="champs">
			<label for="email"><?php echo _("Addesse courriel"); ?> *</label>
			<input type="email" name="email" id="email" required/>			
		</div>
        
        <div class="champs">
			<label for="nom"><?php echo _("Nom"); ?></label>
			<input type="text" name="nom" id="nom"/>			
		</div>
        
        <div class="champs">
			<label for="prenom"><?php echo _("Prenom"); ?></label>
			<input type="text" name="prenom" id="prenom"/>			
		</div>

		<div class="champs">
			<label for="motDePasse"><?php echo _("Mot de passe"); ?> *</label>
			<input type="password" name="motDePasse" id="motDePasse" required/>			
		</div>
        
        <div class="champs">
			<label for="confirmationMotDePasse"><?php echo _("Confirmation du mot de passe"); ?> *</label>
			<input type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" required/>			
		</div>

		<input type="submit" value="<?php echo _("Inscription"); ?>">
	</form>
</section>
	
<?php include "pied-page.php"?>