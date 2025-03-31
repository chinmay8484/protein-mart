<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="success-page">

    <div class="success-container">
        <h2>🎉 Order Placed Successfully! 🎉</h2>
        <p>Thank you for your purchase. Your order ID is: <span id="order-id"></span></p>
        
        <a href="index.html"><button>Continue Shopping</button></a>
    </div>

    <script>
        // Get order ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('order_id');

        if (orderId) {
            document.getElementById('order-id').innerText = orderId;
        } else {
            document.getElementById('order-id').innerText = "N/A";
        }
    </script>

</body>
</html>
