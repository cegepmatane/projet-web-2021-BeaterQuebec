<?php
include_once CHEMIN_MODELE . "Voiture.php";

class AccesBaseDeDonneesVoitures
{
    public static $basededonnees = null;

    public static function initialiser()
    {
        $usager = 'BeaterQuebec';
        $motdepasse = 'BeaterQuebec12!';
        $hote = 'localhost';
        $base = 'BeaterQuebec';
        $dsn = 'mysql:dbname='.$base.';host=' . $hote;
        VoitureDAO::$basededonnees = new PDO($dsn, $usager, $motdepasse);
        VoitureDAO::$basededonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}

class VoitureDAO extends AccesBaseDeDonneesVoitures{
  public static function lireVoiture($id){
      
    VoitureDAO::initialiser();
      
    $MESSAGE_SQL_VOITURE = "SELECT * FROM voitures WHERE id =:id;";

    $requeteListeVoitures = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_VOITURE);
    $requeteListeVoitures->bindParam(':id', $id, PDO::PARAM_INT);
    $requeteListeVoitures->execute();
    $voiture = $requeteListeVoitures->fetch();
    
    return new Voiture($voiture);
  }
  public static function voitureEstVendu($id){
      
    VoitureDAO::initialiser();
      
    $MESSAGE_SQL_LISTE_VENDU = "SELECT * FROM vendus WHERE fk_voiture = :id";

    $requeteListeVendus = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_VENDU);
    $requeteListeVendus->bindParam(':id', $id, PDO::PARAM_INT);
    $requeteListeVendus->execute();
    $listeVendus = $requeteListeVendus->fetch();
      
    if (empty($listeVendus)){
        return false;
    }else{
        return true;
    }
}
public static function lireVendu($id){
      
  VoitureDAO::initialiser();
    
  $MESSAGE_SQL_LISTE_VOITURE = "SELECT * FROM vendus WHERE fk_membre = :id";

  $requeteListeVendus = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_VOITURE);
  $requeteListeVendus->bindParam(':id', $id, PDO::PARAM_INT);
  $requeteListeVendus->execute();
  $listeVendus = $requeteListeVendus->fetchAll();
    
  if (!empty($listeVendus)){
      return $listeVendus;
  }else{
      return null;
  }
}

public static function lireVoitureVendu($id){
      
  VoitureDAO::initialiser();
    
  $MESSAGE_SQL_LISTE_VENDU = "SELECT * FROM voitures WHERE id = :id";

  $requeteListeVendus = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_VENDU);
  $requeteListeVendus->bindParam(':id', $id, PDO::PARAM_INT);
  $requeteListeVendus->execute();
  $listeVendus = $requeteListeVendus->fetch();
    
  if (!empty($listeVendus)){
      
      return new Voiture($listeVendus);
  }else{
      return null;
  }
}


  public static function acheterVoiture($idMembre, $idVoiture, $idStripe){
    VoitureDAO::initialiser();

    $MESSAGE_SQL_VOITURE = "UPDATE voitures SET vendu=1 WHERE id =:id;";

    $requeteAchatVoitures = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_VOITURE);
    $requeteAchatVoitures->bindParam(':id', $idVoiture, PDO::PARAM_INT);
    $requeteAchatVoitures->execute();

    $MESSAGE_SQL_VOITURE = "INSERT INTO `vendus`(`fk_voiture`, `fk_membre`, `id_stripe`) VALUES (:idVoiture, :idMembre, :idStripe)";

    $requeteAchatVoitures = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_VOITURE);
    $requeteAchatVoitures->bindParam(':idVoiture', $idVoiture, PDO::PARAM_INT);
    $requeteAchatVoitures->bindParam(':idMembre', $idMembre, PDO::PARAM_INT);
    $requeteAchatVoitures->bindParam(':idStripe', $idStripe, PDO::PARAM_STR);
    $requeteAchatVoitures->execute();
    
  }

  public static function listerVoiture(){
      
    VoitureDAO::initialiser();
      
    $MESSAGE_SQL_LISTE_VOITURE = "SELECT id, marque, modele, annee, description, prix, kilometrages, image FROM voitures WHERE vendu=0;";

    $requeteListeVoitures = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_VOITURE);
    $requeteListeVoitures->execute();
    $listeVoitures = $requeteListeVoitures->fetchAll();
      
    if (!empty($listeVoitures)){
        foreach($listeVoitures as $voiture) $voitures[] = new Voiture($voiture);
        return $voitures;
    }else{
        return null;
    }
  }

  public static function ajouterVoiture($voiture){
      
    VoitureDAO::initialiser();
      
    $marque = urldecode($voiture['marque']);
    $modele = urldecode($voiture['modele']);
    $description = urldecode($voiture['description']);

    $SQL_AJOUTER_VOITURE = "INSERT into voitures(marque, modele, annee, description, prix, kilometrages, image) VALUES(".":marque,".":modele,".":annee,".":description,".":prix,".":kilometrages,".":image".");";

    $requeteAjouterVoiture = VoitureDAO::$basededonnees->prepare($SQL_AJOUTER_VOITURE);

    $requeteAjouterVoiture->bindParam(':marque', $marque, PDO::PARAM_STR);
    $requeteAjouterVoiture->bindParam(':modele', $modele, PDO::PARAM_STR);
    $requeteAjouterVoiture->bindParam(':annee', $voiture['annee'], PDO::PARAM_STR);
    $requeteAjouterVoiture->bindParam(':description', $description, PDO::PARAM_STR);
    $requeteAjouterVoiture->bindParam(':prix', $voiture['prix'], PDO::PARAM_INT);
    $requeteAjouterVoiture->bindParam(':kilometrages', $voiture['kilometrages'], PDO::PARAM_INT);
    $requeteAjouterVoiture->bindParam(':image', $voiture['image'], PDO::PARAM_STR);

    $reussiteAjout = $requeteAjouterVoiture->execute();
    return $reussiteAjout;
  }

  public static function modifierVoiture($voiture){
      
    VoitureDAO::initialiser();

    $id = $voiture['id'];
      
    $marque = urldecode($voiture['marque']);
    $modele = urldecode($voiture['modele']);
    $description = urldecode($voiture['description']);
      
    if (!empty($voiture['image'])){
         $SQL_MODIFIER_VOITURE = "UPDATE voitures SET marque=".":marque".", modele=".":modele".", annee=".":annee".", description=".":description".", prix=".":prix".", kilometrages=".":kilometrages".", image=".":image"." WHERE id = " . $id;
    }else{
         $SQL_MODIFIER_VOITURE = "UPDATE voitures SET marque=".":marque".", modele=".":modele".", annee=".":annee".", description=".":description".", prix=".":prix".", kilometrages=".":kilometrages"." WHERE id = " . $id;
    }

    $requeteModifiervoiture = VoitureDAO::$basededonnees->prepare($SQL_MODIFIER_VOITURE);

    $requeteModifiervoiture->bindParam(':marque', $marque, PDO::PARAM_STR);
    $requeteModifiervoiture->bindParam(':modele', $modele, PDO::PARAM_STR);
    $requeteModifiervoiture->bindParam(':annee', $voiture['annee'], PDO::PARAM_STR);
    $requeteModifiervoiture->bindParam(':description', $description, PDO::PARAM_STR);
    $requeteModifiervoiture->bindParam(':prix', $voiture['prix'], PDO::PARAM_INT);
    $requeteModifiervoiture->bindParam(':kilometrages', $voiture['kilometrages'], PDO::PARAM_INT);
      
    if (!empty($voiture['image'])){
        $requeteModifiervoiture->bindParam(':image', $voiture['image'], PDO::PARAM_STR);
    }

    $reussiteModification = $requeteModifiervoiture->execute();
    return $reussiteModification;
  }

  public static function supprimerVoiture($id){
      
    VoitureDAO::initialiser();
      
    $SQL_SUPPRIMER_VOITURE = "DELETE FROM voitures WHERE id = " . $id;

    $requeteSupprimerVoiture = VoitureDAO::$basededonnees->prepare($SQL_SUPPRIMER_VOITURE);
    $requeteSupprimerVoiture->execute();

    $reussiteSupprimer = $requeteSupprimerVoiture->execute();

    return $reussiteSupprimer;
  }

  public static function lireRechercheRapide($textRecherche){
      
    VoitureDAO::initialiser();
      
    if (empty($textRecherche))
      $MESSAGE_SQL_LISTE_RESULTAT_RECHERCHE = "SELECT id, marque, modele, annee, description, prix, kilometrages, image FROM voitures WHERE vendu = 0 AND (marque LIKE '%null%' OR modele LIKE '%null%' OR annee LIKE '%null%' OR description LIKE '%null%');";
    else
      $MESSAGE_SQL_LISTE_RESULTAT_RECHERCHE = "SELECT id, marque, modele, annee, description, prix, kilometrages, image FROM voitures WHERE vendu = 0 AND (marque LIKE '%$textRecherche%' OR modele LIKE '%$textRecherche%' OR annee LIKE '%$textRecherche%' OR description LIKE '%$textRecherche%');";

    $requeteResultatRecherche = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_RESULTAT_RECHERCHE);
    $requeteResultatRecherche->execute();
    $listResultatRecherche = $requeteResultatRecherche->fetchAll();
      
    if (!empty($listResultatRecherche)){
        foreach($listResultatRecherche as $resultat) $resultats[] = new Voiture($resultat);
        return $resultats;
    }else{
        return null;
    }
  }

  public static function lireRechercheAvance($marque, $modele, $anneeMin, $anneeMax, $prixMax, $kilometragesMax){
      
    VoitureDAO::initialiser();

    $conditions = array();
    if(!empty($marque))
    {
        $conditions[ ] =  " marque LIKE '%$marque%' ";
    }
    if(!empty($modele))
    {
        $conditions[ ]  = " modele LIKE '%$modele%' ";
    }
    if(!empty($anneeMin) && !empty($anneeMax))
    {
        $conditions[ ]  = " annee BETWEEN '$anneeMin' AND '$anneeMax'";
    }
    if(!empty($prixMax))
    {
        $conditions[ ]  = " prix BETWEEN '0' AND '$prixMax'";
    }
    if(!empty($kilometragesMax))
    {
        $conditions[ ]  = " kilometrages BETWEEN '0' AND '$kilometragesMax'";
    }
    if(!empty($conditions))
    {
      $sql = "SELECT id, marque, modele, annee, description, prix, kilometrages, image FROM voitures WHERE vendu = 0 AND ";
      $sql = $sql . implode(' AND ', $conditions);
    }
    
    $MESSAGE_SQL_LISTE_RESULTAT_RECHERCHE_AVANCE = $sql;

    $requeteResultatRecherche = VoitureDAO::$basededonnees->prepare($MESSAGE_SQL_LISTE_RESULTAT_RECHERCHE_AVANCE);
    $requeteResultatRecherche->execute();
    $listResultatRecherche = $requeteResultatRecherche->fetchAll();

    if (!empty($listResultatRecherche)){
        foreach($listResultatRecherche as $resultat) $resultats[] = new Voiture($resultat);
        return $resultats;
    }else{
        return null;
    }
  }
}

if(!function_exists ('formater'))
{
  function formater($texte)
  {
      $texte = html_entity_decode($texte,ENT_COMPAT,'UTF-8');
      $texte = htmlentities($texte,ENT_COMPAT,'ISO-8859-1');
      
      $newText = urldecode($texte);
      
      return $newText;

  }
}

?>