<?php
require __DIR__ . "/vendor/autoload.php";

$sk = "sk_test_51NqCvMSFUB8hRccu7R1yLWaRLnuI3LDvfsfw7k7B8bQz6m9WFhAZ2SX9A8WVk26cskglAXwhChbky4LpiL1yYd2000KB2NWcuV";

\Stripe\Stripe::setApiKey($sk);


// Create the checkout session
$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/suborno/success.php",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "INR",
                "unit_amount"=> 2000 * 100,
                "product_data" => [
                    "name" => "Baby Doll",

                ],
            ],
        ],
    ],
]);

// Redirect to checkout page
http_response_code(303);
header("Location:" . $checkout_session->url);
// Add this in your checkout.php for debugging
error_log("Checkout session created successfully: " . $checkout_session->id);
?>