<?php 
// Include configuration file  
require_once 'config.php'; 
 
// Include database connection file  
include_once 'dbConnection.php'; 
 
$payment_id = $statusMsg = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe checkout session is not empty 
if(!empty($_GET['session_id'])){ 
    $session_id = $_GET['session_id']; 
     
    // Fetch transaction data from the database if already exists 
    $sql = "SELECT * FROM orders WHERE checkout_session_id = '".$session_id."'"; 
    $result = $db->query($sql); 
    if($result->num_rows > 0){ 
        $orderData = $result->fetch_assoc(); 
         
        $paymentID = $orderData['id']; 
        $transactionID = $orderData['txn_id']; 
        $paidAmount = $orderData['paid_amount']; 
        $paidCurrency = $orderData['paid_amount_currency']; 
        $paymentStatus = $orderData['payment_status']; 
         
        $ordStatus = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
    }else{ 
        // Include Stripe PHP library  
        require_once 'stripe-php/init.php'; 
         
        // Set API key 
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
         
        // Fetch the Checkout Session to display the JSON result on the success page 
        try { 
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id); 
        }catch(Exception $e) {  
            $api_error = $e->getMessage();  
        } 
         
        if(empty($api_error) && $checkout_session){ 
            // Retrieve the details of a PaymentIntent 
            try { 
                $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent); 
            } catch (\Stripe\Exception\ApiErrorException $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            // Retrieves the details of customer 
            try { 
                // Create the PaymentIntent 
                $customer = \Stripe\Customer::retrieve($checkout_session->customer); 
            } catch (\Stripe\Exception\ApiErrorException $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $intent){  
                // Check whether the charge is successful 
                if($intent->status == 'succeeded'){ 
                    // Customer details 
                    $name = $customer->name; 
                    $email = $customer->email; 
                     
                    // Transaction details  
                    $transactionID = $intent->id; 
                    $paidAmount = $intent->amount; 
                    $paidAmount = ($paidAmount/100); 
                    $paidCurrency = $intent->currency; 
                    $paymentStatus = $intent->status; 
                     
                    // Insert transaction data into the database 
                    $sql = "INSERT INTO orders(name,email,item_name,item_number,item_price,item_price_currency,paid_amount,paid_amount_currency,txn_id,payment_status,checkout_session_id,created,modified) VALUES('".$name."','".$email."','".$productName."','".$productID."','".$productPrice."','".$currency."','".$paidAmount."','".$paidCurrency."','".$transactionID."','".$paymentStatus."','".$session_id."',NOW(),NOW())"; 
                    $insert = $db->query($sql); 
                    $paymentID = $db->insert_id; 
                     
                    // If the order is successful 
                    if($paymentStatus == 'succeeded'){ 
                        $statusMsg = 'Your Payment has been Successful!'; 
                    }else{ 
                        $statusMsg = "Your Payment has failed!"; 
                    } 
                }else{ 
                    $statusMsg = "Transaction has been failed!"; 
                } 
            }else{ 
                $statusMsg = "Unable to fetch the transaction details! $api_error";  
            } 
             
            $ordStatus = 'success'; 
        }else{ 
            $statusMsg = "Transaction has been failed! $api_error";  
        } 
    } 
}else{ 
    $statusMsg = "Invalid Request!"; 
} 
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Stripe Payment Status - CodexWorld</title>
<meta charset="utf-8">

<!-- Stylesheet file -->
</head>
<body>
<div class="container">
    <div class="status">
        <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
        <?php if(!empty($paymentID)){ ?>
            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $paymentID; ?></p>
            <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
            <p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
            <p><b>Payment Status:</b> <?php echo $paymentStatus; ?></p>
			
            <h4>Product Information</h4>
            <p><b>Name:</b> <?php echo $productName; ?></p>
            <p><b>Price:</b> <?php echo $productPrice.' '.$currency; ?></p>
        <?php } ?>
    </div>
    <a href="index.php" class="btn-link">Back to Product Page</a>
</div>
</body>
</html>