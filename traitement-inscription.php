<?php
require "configuration.php";
require CHEMIN_ACCESSEUR . "MembreDAO.php";

/*$repertoireImage = $_SERVER['DOCUMENT_ROOT'] . "/ProjetListPhp/projet-serveur-web-2020-CharlesC1337/images/";

$fichierDestination = $repertoireImage . $_FILES['image']['name'];

$fichierSource = $_FILES['image']['tmp_name'];

$image =  $_FILES['image']['name'];

if(move_uploaded_file($fichierSource,$fichierDestination))
{?>
	Votre envoi de fichier a bien fonctionné
	<img src="../images/<?=$_FILES['image']['name']?>" alt=""/>
	<?php
}*/

$filtresMembre = [];

$filtresMembre['pseudonyme'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['nom'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['prenom'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['email'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['motDePasse'] = FILTER_SANITIZE_ENCODED;
$filtresMembre['confirmationMotDePasse'] = FILTER_SANITIZE_ENCODED;

$membre = filter_input_array(INPUT_POST, $filtresMembre);

if (strcmp($membre['motDePasse'],$membre['confirmationMotDePasse'])){
    echo '<script type="text/javascript">'; 
    echo 'alert("Les mots de passe ne correspondent pas!");'; 
    echo 'window.location.href = "inscription.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}

$membre['motDePasse'] = password_hash($membre['motDePasse'], PASSWORD_DEFAULT);

$checkPseudonyme = MembreDAO::lireMembreParPseudonyme($membre["pseudonyme"]);

if (isset($checkPseudonyme->id)){
    echo '<script type="text/javascript">'; 
    echo 'alert("Ce nom d\'utilisateur éxiste déjà!");'; 
    echo 'window.location.href = "inscription.php?lang='.$_GET['lang'];
    echo '";';
    echo '</script>';
}else{
    $checkCourriel = MembreDAO::lireMembreParCourriel($membre["email"]);

    if (isset($checkCourriel->id)){
        echo '<script type="text/javascript">'; 
        echo 'alert("Cette addresse de courriel éxiste déjà!");'; 
        echo 'window.location.href = "inscription.php?lang='.$_GET['lang'];
        echo '";';
        echo '</script>';
    }else{
        $reussiteAjout = MembreDAO::ajouterMembre($membre);
        
        if($reussiteAjout) 
        {
            $Mail = urldecode($membre["email"]);
            
            mail($Mail,"Inscription à les Beaters du Québec", "Merci de votre inscription. Si ce n'était pas vous ou si vous rencontrez un problème quelconque veuillez nous contacter à l'adresse suivante : support@beaterquebec.shop.");
            header("Location: membre.php?lang=".$_GET['lang']);
            die();	
        }
    }
}
//$membre['image'] = $image;
?>
