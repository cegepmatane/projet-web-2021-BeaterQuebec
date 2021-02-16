<?php
include_once CHEMIN_MODELE . "Membre.php";

class AccesBaseDeDonneesMembres
{
    public static $basededonnees = null;

    public static function initialiser()
    {
        $usager = 'BeaterQuebec';
        $motdepasse = 'BeaterQuebec12!';
        $hote = 'localhost';
        $base = 'BeaterQuebec';
        $dsn = 'mysql:dbname='.$base.';host=' . $hote;
        MembreDAO::$basededonnees = new PDO($dsn, $usager, $motdepasse);
        MembreDAO::$basededonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

class MembreDAO extends AccesBaseDeDonneesMembres{
    public static function validerConnexion($membre){
        
        MembreDAO::initialiser();

        $MESSAGE_SQL_VALIDER_CONNEXION = "SELECT * FROM membre WHERE pseudonyme =:pseudonyme OR email=:email;";

        $pseudonyme = urldecode(formater($membre->pseudonyme));
        $email = urldecode(formater($membre->email));

        $requeteValiderConnexion = MembreDAO::$basededonnees->prepare($MESSAGE_SQL_VALIDER_CONNEXION);
        $requeteValiderConnexion->bindParam(':pseudonyme', $pseudonyme, PDO::PARAM_STR);
        $requeteValiderConnexion->bindParam(':email', $email, PDO::PARAM_STR);
        $requeteValiderConnexion->execute();

        $resultatRequete = $requeteValiderConnexion->fetch();

        $hasedPwdCheck = password_verify(formater($membre->motDePasse), $resultatRequete['motDePasse']);

        if ($hasedPwdCheck){
            return new Membre($resultatRequete);
        }else{
            return null;
        }
    } 
    public static function listerMembre(){
      
        MembreDAO::initialiser();
          
        $MESSAGE_SQL_LISTE_MEMBRE = "SELECT * FROM membre;";
    
        $requeteListeMembres = MembreDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_MEMBRE);
        $requeteListeMembres->execute();
        $listeMembres = $requeteListeMembres->fetchAll();
          
        if (!empty($listeMembres)){
            foreach($listeMembres as $membre) $membres[] = new Membre($membre);
            return $membres;
        }else{
            return null;
        }
    }
    public static function supprimerMembre($id){
    
        MembreDAO::initialiser();
            
        $SQL_SUPPRIMER_MEMBRE = "DELETE FROM membre WHERE id = " . $id;

        $requeteSupprimerMembre = MembreDAO::$basededonnees->prepare($SQL_SUPPRIMER_MEMBRE);
        $requeteSupprimerMembre->execute();

        $reussiteSupprimer = $requeteSupprimerMembre->execute();

        return $reussiteSupprimer;
    }
    public static function ajouterMembre($membre){
        
        MembreDAO::initialiser();
        
        $SQL_AJOUTER_MEMBRE = "INSERT into membre(pseudonyme, nom, prenom, email, motDePasse) VALUES(".":pseudonyme,".":nom".",".":prenom".",".":email".",".":motDePasse".");";

        $requeteAjouterMembre = MembreDAO::$basededonnees->prepare($SQL_AJOUTER_MEMBRE);
        
        $pseudonyme = urldecode($membre["pseudonyme"]);
        $nom = urldecode($membre["nom"]);
        $prenom = urldecode($membre["prenom"]);
        $email = urldecode($membre["email"]);

        $requeteAjouterMembre->bindParam(':pseudonyme', $pseudonyme, PDO::PARAM_STR);
        $requeteAjouterMembre->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requeteAjouterMembre->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requeteAjouterMembre->bindParam(':email', $email, PDO::PARAM_STR);
        $requeteAjouterMembre->bindParam(':motDePasse', $membre["motDePasse"], PDO::PARAM_STR);

        $reussiteAjout = $requeteAjouterMembre->execute();
        return $reussiteAjout;
    }
    public static function modifierMembreInfo($membre){
        
        MembreDAO::initialiser();
        
        $SQL_MODIFIER_MEMBRE = "UPDATE membre SET pseudonyme = ".":pseudonyme".", nom = ".":nom".", prenom = ".":prenom".", email = ".":email"." WHERE id = :id";

        $requeteModifierMembre = MembreDAO::$basededonnees->prepare($SQL_MODIFIER_MEMBRE);
        
        $pseudonyme = urldecode($membre["pseudonyme"]);
        $nom = urldecode($membre["nom"]);
        $prenom = urldecode($membre["prenom"]);
        $email = urldecode($membre["email"]);

        $requeteModifierMembre->bindParam(':pseudonyme', $pseudonyme, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':email', $email, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':id', $_SESSION["id"], PDO::PARAM_STR);
        
        $reussiteModification = $requeteModifierMembre->execute();
        return $reussiteModification;
    }
    public static function modifierMotDePasse($membreNouveauMotDePasse){
        
        MembreDAO::initialiser();

        $SQL_MODIFIER_MEMBRE = "UPDATE membre SET motDePasse = ".":motDePasse"." WHERE id = :id";

        $requeteModifierMembre = MembreDAO::$basededonnees->prepare($SQL_MODIFIER_MEMBRE);
    
        $requeteModifierMembre->bindParam(':motDePasse', $membreNouveauMotDePasse, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':id', $_SESSION["id"], PDO::PARAM_STR);
        
        $reussiteModification = $requeteModifierMembre->execute();
        return $reussiteModification;
    }
    public static function modifierMotDePasseParPseudonyme($membreNouveauMotDePasse,$pseudonyme){
        
        MembreDAO::initialiser();

        $SQL_MODIFIER_MEMBRE = "UPDATE membre SET motDePasse = ".":motDePasse"." WHERE pseudonyme = :pseudonyme";

        $requeteModifierMembre = MembreDAO::$basededonnees->prepare($SQL_MODIFIER_MEMBRE);
    
        $requeteModifierMembre->bindParam(':motDePasse', $membreNouveauMotDePasse, PDO::PARAM_STR);
        $requeteModifierMembre->bindParam(':pseudonyme', $pseudonyme, PDO::PARAM_STR);
        
        $reussiteModification = $requeteModifierMembre->execute();
        return $reussiteModification;
    }
    public static function lireMembreParPseudonyme($pseudonyme){
        
        MembreDAO::initialiser();
        
        $pseudo = urldecode($pseudonyme);
        
        $MESSAGE_SQL_LIRE_MEMBRE_PAR_PSEUDONYME = "SELECT * FROM membre WHERE pseudonyme =:pseudonyme;";

        $requeteLireMembreParPseudonyme = MembreDAO::$basededonnees->prepare($MESSAGE_SQL_LIRE_MEMBRE_PAR_PSEUDONYME);
        $requeteLireMembreParPseudonyme->bindParam(':pseudonyme', $pseudo, PDO::PARAM_STR);
        $requeteLireMembreParPseudonyme->execute();

        $membre = $requeteLireMembreParPseudonyme->fetch();

        return new Membre($membre);
    }
    public static function lireMembreParCourriel($courriel){
        
        MembreDAO::initialiser();
        
        $email = urldecode($courriel);
        
        $MESSAGE_SQL_LIRE_MEMBRE_PAR_COURRIEL = "SELECT id, email FROM membre WHERE email =:email;";

        $requeteLireMembreParCourriel = MembreDAO::$basededonnees->prepare($MESSAGE_SQL_LIRE_MEMBRE_PAR_COURRIEL);
        $requeteLireMembreParCourriel->bindParam(':email', $email, PDO::PARAM_STR);
        $requeteLireMembreParCourriel->execute();

        $membre = $requeteLireMembreParCourriel->fetch();

        return new Membre($membre);
    }
}

function formater($texte)
{
    $texte = html_entity_decode($texte,ENT_COMPAT,'UTF-8');
    $texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
    
    $newText = urldecode($texte);
    
    return $newText;
}
?>