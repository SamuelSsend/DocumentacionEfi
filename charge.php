<?php
require_once 'config.php';
 
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
 
$customer = \Stripe\Customer::create(
    [
    'email' => $email,
    'source'  => $token,
    ]
);
 
$charge = \Stripe\Charge::create(
    [
    'customer' => $customer->id,
    'amount'   => 100,
    'currency' => 'eur',
    ]
);
 
echo '<h1>Successfully charged 1€!</h1>';
?>