<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Checkout</title>
    
</head>
<body>
    <?php

        $item = $_GET['item'];
        $price = $_GET['price'];

    ?>
    <form action="checkout.php" method="get">
        <h1><?php echo $item ?></h1>
        <p><strong><?php echo $price ?></strong></p>
        <button><a href="checkout.php?item=<?php echo $item ?>&price=<?php echo $price ?>">Checkout</a></button>
        <button><a href="index.html">Cancel and Return back</a></button>
    </form>
</body>
</html>