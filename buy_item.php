<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="refresh" content="15">
    <link rel="stylesheet" href="styles/buy_item_style.css">
    <link href='https://fonts.googleapis.com/css?family=Alkatra' rel='stylesheet'>

    <title>Checkout</title>
    
    <style>
        /* Add some basic styling for the buttons */
        .quantity-btn {
            cursor: pointer;
            font-size: 16px;
            padding: 5px 10px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <?php
        $item = $_GET['item'];
        $price =$_GET['price'];
    ?>
    <header>
        <h1>Items</h1>
    </header>
    <form action="checkout.php" method="get">
        <h2><?php echo $item; ?></h2>  
        <p>Price: <strong id="item-price"><?php echo $price; ?></strong></p>
        
        <!-- Plus and minus buttons for quantity -->
        <button type="button" class="quantity-btn" onclick="updateQuantity('minus', '<?php echo $item; ?>', '<?php echo $price; ?>')">-</button>
        <!-- Make the quantity field read-only -->
        <input type="text" id="quantity" name="quantity" value="1" readonly>
        <button type="button" class="quantity-btn" onclick="updateQuantity('plus', '<?php echo $item; ?>', '<?php echo $price; ?>')">+</button>

        <!-- Display total price -->
        <p>Total Price: Rs:<strong id="total-price"><?php echo number_format($price, 2); ?></strong></p>

        <!-- Add hidden input fields for item and price -->
        <input type="hidden" name="item" value="<?php echo $item; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        
        <!-- Submit the form directly without JavaScript -->
        <button type="submit">Checkout</button>
        <button><a href="index.html">Cancel and Return back</a></button>
    </form>

    <script>
    // Function to update quantity and total price
    function updateQuantity(action, item, price) {
        var quantityInput = document.querySelector('input[name="quantity"]');
        var quantity = parseInt(quantityInput.value);

        if (action === 'plus') {
            quantity += 1;
        } else if (action === 'minus' && quantity > 1) {
            quantity -= 1;
        }

        quantityInput.value = quantity;

        var itemPrice = parseFloat(price);
        var totalPrice = quantity * itemPrice;

        document.getElementById('total-price').textContent = totalPrice.toFixed(2);

        var checkoutLink = document.getElementById("checkout");
        checkoutLink.href = 'checkout.php?quantity=' + quantity + '&item=' + encodeURIComponent(item) + '&price=' + encodeURIComponent(price);
    }
</script>

</body>
</html>