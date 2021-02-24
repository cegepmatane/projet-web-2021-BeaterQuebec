<?php 
include "entete.php";

// Include configuration file
require "../configuration.php";
require CHEMIN_ACCESSEUR . "VoitureDAO.php";  
require_once 'stripe-php/init.php';
require_once 'config.php';

 
// Include database connection file  
 
$statusMsg = ''; 
$ordStatus = 'error';
\Stripe\Stripe::setApiKey('sk_test_51ILubkC6za7rocHnNsuMY7Ubuy7lxlG6C0pfTRzh8tD2cFrhVKgivmEMHqJrANNuJZjv3Sba3EBG7kM60YkK8AeV00kMwxFB08');

if (isset($_SESSION['id'])){
    if(!empty($_GET['session_id'])&&!empty($_GET['voiture']))
    {
        $session_id = $_GET['session_id'];
        try { 
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id); 
        }catch(Exception $e) {  
            $api_error = $e->getMessage();  
        } 

        if(empty($api_error) && $checkout_session){ 

            if (!VoitureDAO::voitureEstVendu($_GET['voiture']))
            {
                VoitureDAO::acheterVoiture($_SESSION['id'], $_GET['voiture'], $session_id);
                $statusMsg = 'Payment Réussi!';

                $voiture = VoitureDAO:lireVoiture($_GET['voiture']);
                
                $headers = 'From: support@beaterquebec.shop' . "\r\n" .
                'Reply-To: support@beaterquebec.shop' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                mail($_SESSION["email"],"Facture Beaters du Québec", "Merci de votre Achat sur BeaterQuebec : " . formater($voiture->marque) . formater($voiture->modele) . formater($voiture->prix) . " Si ce n'était pas vous ou si vous rencontrez un problème quelconque veuillez nous contacter à l'adresse suivante : support@beaterquebec.shop.", $headers);

            }else{
                $statusMsg = 'Voiture deja vendu!';
            }
        }else{
            $statusMsg = 'Payment incorrect!';
        }
    }else{
        $statusMsg = 'Aucune voiture choisi!';
    }
}else{
    echo '<script type="text/javascript">';  
    echo 'window.location.href = "../index.php";';
    echo 'history.go(-1);';
    echo '</script>';
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>BeaterQc</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/projetWeb/styles/style.css">

<!-- Stylesheet file -->
</head>
<body>
<div class="container">
    <div class="status">
        <h1><?php echo $statusMsg; ?></h1>
    </div>
    <br>
    <a class="boutonThemeMenu" href="../liste-voiture.php" class="btn-link">Retour a liste de voiture</a>
</div>
</body>
</html>

<?php include "../pied-page.php";?>