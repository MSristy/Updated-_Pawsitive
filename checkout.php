<?php
session_start();
include('db_connect.php');

// Check if the cart is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Example cart data (replace with your actual cart session data)
$cart = $_SESSION['cart'];
$total = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cart));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - PAWSITIVE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#f9f9f9; /* rgb(175, 136, 136);*/
        }

        header {
        background: linear-gradient(135deg,rgb(171, 219, 231),rgb(228, 205, 161));
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo img {
            height: 50px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        main {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .checkout-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .checkout-form label {
            font-weight: bold;
        }

        .checkout-form textarea,
        .checkout-form input,
        .checkout-form select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        .checkout-form .btn-checkout {
            background-color:rgb(197, 97, 88);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .checkout-form .btn-checkout:hover {
            background-color:rgb(192, 91, 86);
        }

       footer {
            background-color: #009990;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #ccc;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color:rgb(165, 80, 73);
            color: white;
        }

        table tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo1.jpg" alt="PAWSITIVE">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="marketplace.php">Marketplace</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </nav>
</header>

<main>
    <h1>Checkout</h1>
    <section class="order-summary">
        <h2>Order Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $id => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><b>Total:</b></td>
                    <td><b>$<?= number_format($total, 2) ?></b></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="checkout-form">
        <h2>Billing Details</h2>
        <form action="donation.php" method="GET">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Shipping Address</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <!-- Hidden field for total amount -->
            <input type="hidden" name="total" value="<?= $total ?>">

            <button type="submit" class="btn-checkout">Place Order</button>
        </form>
    </section>
</main>

<?php include('templates/footer.php'); ?>

</body>
</html>





  