<?php
require __DIR__ . "/vendor/autoload.php";

$sk = "sk_test_51NqCvMSFUB8hRccu7R1yLWaRLnuI3LDvfsfw7k7B8bQz6m9WFhAZ2SX9A8WVk26cskglAXwhChbky4LpiL1yYd2000KB2NWcuV";

\Stripe\Stripe::setApiKey($sk);

// print_r($_GET);
$item = isset($_GET['item']) ? $_GET['item'] : "";
$price = isset($_GET['price']) ? $_GET['price'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;


// Create the checkout session
$checkout_session = \Stripe\Checkout\Session::create([
   "mode" => "payment",
   "success_url" => "http://stripe_payment_gateway.dvl.to/success.php",
   "cancel_url" => "http://stripe_payment_gateway.dvl.to/index.html",
   "line_items" => [
       [
           "quantity" => $quantity,
           "price_data" => [
               "currency" => "INR",
               "unit_amount"=> floatval($price) * 100,
               "product_data" => [
                  "name" => $item,
               ],
           ],
       ],
   ],
]);

// Redirect to checkout page
http_response_code(303);
header("Location:".$checkout_session->url);
// Add this in your checkout.php for debugging
error_log("Checkout session created successfully: " . $checkout_session->id);
?>