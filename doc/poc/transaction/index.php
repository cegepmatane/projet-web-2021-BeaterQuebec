<?php 
// Include configuration file   
require_once 'config.php';
include_once 'dbConnection.php';    
?>
<script src="https://js.stripe.com/v3/"></script>



<!-- Display errors returned by checkout session -->
<div id="paymentResponse"></div>
	
<!-- Product details -->
<h2><?php echo $productName; ?></h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<p>Price: <b>$<?php echo $productPrice.' '.strtoupper($currency); ?></b></p>

<!-- Buy button -->
<div id="buynow">
    <button class="stripe-button" id="payButton">Buy Now</button>
</div>

<script>
var buyBtn = document.getElementById('payButton');
var responseContainer = document.getElementById('paymentResponse');
    
// Create a Checkout Session with the selected product
var createCheckoutSession = function (stripe) {
    return fetch("stripe_charge.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
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
