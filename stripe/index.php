<?php 
// Include configuration file
require_once 'stripe/config.php';     
?>
<script src="https://js.stripe.com/v3/"></script>


<!-- productName: document.getElementById('produitNom').innerHTML-->
<!-- Display errors returned by checkout session -->
<div id="paymentResponse"></div>
	

<!-- Buy button -->
<div id="buynow">
    <button class="boutonThemeMenu" id="payButton"><?php echo _('Acheter'); ?></button>
</div>

<script>
var buyBtn = document.getElementById('payButton');
var responseContainer = document.getElementById('paymentResponse');
    
// Create a Checkout Session with the selected product
var createCheckoutSession = function (stripe) {
    return fetch("stripe/stripe_charge.php" , {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
            productName: document.getElementById('produitNom').innerHTML,
            productPrice: document.getElementById('prixProduit').innerHTML,
            idVoiture: <?php echo $_GET['voiture']; ?>
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
    if (result.error) {
        responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
    }
    buyBtn.disabled = false;
    buyBtn.textContent = 'Buy Now';
};

// Specify Stripe publishable key to initialize Stripe.js
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

buyBtn.addEventListener("click", function (evt) {
    buyBtn.disabled = true;
    buyBtn.textContent = 'Please wait...';
    
    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
</script>
