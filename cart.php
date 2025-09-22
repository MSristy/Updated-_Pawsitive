<?php
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cart));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - PAWSITIVE</title>
    <link rel="stylesheet" href="style_cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    
    /* Ensure the body and html take full height */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Main content takes up the remaining space */
        main {
            flex: 1;
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
            height: 70px;
        }


        /* Footer styling */
        footer {
            background:linear-gradient(135deg,rgb(105, 108, 109),rgb(104, 104, 110));
            text-align: center;
            padding: 10px 20px;
            border-top: 1px solid #ccc;
        }


</style>
        

</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo1.jpg" alt="PAWSITIVE">
    </div>
    <nav class="nav">
        <ul class="nh">
            <li><a href="index.php"><b>Home</b></a></li>
            <li><a href="find-a-pet.php"><b>Find a Pet</b></a></li>
            <li><a href="rehomers.php"><b>Rehomers</b></a></li>
            <li><a href="blog.php"><b>Blog</b></a></li>
            <li><a href="vatenary.php"><b>Veterinary</b></a></li>
            <li><a href="marketplace.php"><b>Marketplace</b></a></li>
            <li><a href="user_profile.php"><b>Profile</b></a></li>
            <li><a href="notification.php"><b>Notification</b></a></li>
        </ul>
    </nav>
    <div class="auth-buttons cart-icon">
        <a href="login.php" class="btn-login"><b>Login</b></a>
        <a href="logout.php" class="btn-logout"><b>Logout</b></a>
        <a href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count"><?= array_sum(array_column($cart, 'quantity')) ?></span>
        </a>
    </div>
</header>

<main>
    <h1>Your Shopping Cart</h1>
    <?php if (!empty($cart)): ?>
        <table class="cart-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart as $id => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>
                        <form method="POST" action="update_cart.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" name="action" value="decrease" class="btn-quantity">-</button>
                        </form>
                        <?= $item['quantity'] ?>
                        <form method="POST" action="update_cart.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" name="action" value="increase" class="btn-quantity">+</button>
                        </form>
                    </td>
                    <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    <td>
                        <form method="POST" action="update_cart.php">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" name="action" value="remove" class="btn-quantity">x</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"><b>Total:</b></td>
                <td><b>$<?= number_format($total, 2) ?></b></td>
                <td></td>
            </tr>
            </tfoot>
        </table>
        <div class="cart-actions">
            <a href="marketplace.php" class="btn btn-continue-shopping">Continue Shopping</a>
            <a href="checkout.php" class="btn btn-checkout">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p>Your cart is empty. <a href="marketplace.php">Start shopping now!</a></p>
    <?php endif; ?>
</main>

<footer>
    <div class="footer-links">
        <a href="faq.php">FAQ</a>
        <a href="guidelines.php">Adoption Guidelines</a>
        <a href="about-us.php">Contact Us</a>
        <a href="privacy_policy.php">Privacy Policy</a>
        <a href="term_of_service.php">Terms of Service</a>
    </div>
    <p>&copy; 2024 PAWSITIVE. All Rights Reserved.</p>
</footer>
</body>
</html>
