<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="refresh" content="15">
    <link href='https://fonts.googleapis.com/css?family=Alkatra' rel='stylesheet'>
    <link rel="stylesheet" href="/styles/buy_item_style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
    <title>Checkout</title>
</head>
<body>
    <?php
        $item = $_GET['item'];
        $price = $_GET['price'];
    ?>
    <header>
        <h1>Items</h1>
    </header>
    <form>
        <h2><?php echo $item; ?></h2>  
        <p>Price: <strong id="item-price"><?php echo $price; ?></strong></p>
        
        <!-- Plus and minus buttons for quantity -->
        <button type="button" class="quantity-btn" onclick="updateQuantity('minus', '<?php echo $item; ?>', '<?php echo $price; ?>')">-</button>
        <!-- Make the quantity field read-only -->
        <input type="text" id="quantity" name="quantity" value="1" readonly>
        <button type="button" class="quantity-btn" onclick="updateQuantity('plus', '<?php echo $item; ?>', '<?php echo $price; ?>')">+</button>

        <!-- Display total price -->
        <p>Total Price: Rs:<strong id="total-price"><?php echo $price; ?></strong></p>

        <button><a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="<?php echo $price; ?>" data-name="<?php echo $item; ?>">
            Order Now
        </a></button>
        
        <button><a href="index.html">Cancel and Return back</a></button>
    </form>
    

    <!-- Function to update quantity and total price -->
    <script>
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

            // Update the total price display
            document.getElementById('total-price').textContent = totalPrice.toFixed(2);

            // Update the data-amount attribute of the "Order Now" button
            $('.buy_now').attr('data-amount', totalPrice);
        }
    </script>

    <!-- Razorpay scripts -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // Script for Razorpay integration
        $('body').on('click', '.buy_now', function(e){
            var totalAmount = parseInt($(this).attr("data-amount"), 10);
            var product_name =  $(this).attr("data-name");
            var options = {
                "key": "rzp_test_cynN5CvvIs5uUo",
                "amount": (totalAmount*100),
                "name": product_name,
                "description": "Payment",
                "handler": function (response){
                    $.ajax({
                        url: 'http://stripe_payment_gateway.dvl.to/checkout.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id,
                            totalAmount: totalAmount,
                        },
                        success: function (msg) {
                            window.location.href = 'http://stripe_payment_gateway.dvl.to/success.php';
                        }
                    });
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>
</body>
</html>
