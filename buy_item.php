<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="refresh" content="15">
    <link rel="stylesheet" href="styles/buy_item_style.css">
    <link href='https://fonts.googleapis.com/css?family=Alkatra' rel='stylesheet'>

    <title>Checkout</title>
    
</head>
<body>
    <?php

        $item = $_GET['item'];
        $price = $_GET['price'];
        // $image = $_GET['image'];

    ?>
    <Header>
        <h1>Items</h1>
    </Header>
    <form action="checkout.php" method="get">
        <img src="<?php echo $image ?>" alt="Item Image">
        <h2><?php echo $item ?></h2>
        <p>Price: <strong><?php echo $price ?></strong></p>
        <button><a href="checkout.php?item=<?php echo $item ?>&price=<?php echo $price ?>">Checkout</a></button>
        <button><a href="index.html">Cancel and Return back</a></button>
    </form>
</body>
</html>