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

$stripe = new \Stripe\StripeClient('sk_test_51NqCvMSFUB8hRccu7R1yLWaRLnuI3LDvfsfw7k7B8bQz6m9WFhAZ2SX9A8WVk26cskglAXwhChbky4LpiL1yYd2000KB2NWcuV'

);

$stripe->paymentIntents->create
([
  'amount' => $price,
  'currency' => 'inr',
  'automatic_payment_methods' => ['enabled' => true],
  'application_fee_amount' =>[ ]

]);

?>