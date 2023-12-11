<?php
require __DIR__ . "/vendor/autoload.php";

$sk = "sk_test_51NqCvMSFUB8hRccu7R1yLWaRLnuI3LDvfsfw7k7B8bQz6m9WFhAZ2SX9A8WVk26cskglAXwhChbky4LpiL1yYd2000KB2NWcuV";

\Stripe\Stripe::setApiKey($sk);

// print_r($_GET);
$item = htmlspecialchars($_GET['item']);
$price = htmlspecialchars($_GET['price']);
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

if (empty($item)) {
    // Handle the error, you can redirect or display an error message
    echo "Error: Item name is empty";
    exit;
}

// Create the checkout session
$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "https://payment-gateway-dt6t.onrender.com/success.php",
    "cancel_url" => "https://payment-gateway-dt6t.onrender.com/index.html",
    "line_items" => [
        [
            "quantity" => $quantity,
            "price_data" => [
                "currency" => "INR",
                "unit_amount" => floatval($price) * 100,
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