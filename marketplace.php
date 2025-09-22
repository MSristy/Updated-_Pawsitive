<?php
session_start();
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$sql = "SELECT * FROM products";
if ($category != 'all') {
    $sql .= " WHERE category = '$category'";
}
$result = $conn->query($sql);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSITIVE - Pet Adoption Platform</title>
    <link rel="stylesheet" href="style_marketplace.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background: linear-gradient(135deg,rgb(171, 219, 231),rgb(228, 205, 161));
        
        color: black;
        }

        footer {
            background:linear-gradient(135deg,rgb(105, 108, 109),rgb(104, 104, 110));
            color: black;
            text-align: center;
            padding: 20px;
            height: 60px;
       }
       .footer-links {
        color: black;
        text-decoration: none;
        margin: 0 10px;
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
                <span class="cart-count"><?= $cart_count ?></span>
            </a>
        </div>
    </header>
    
</body>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsitive Marketplace</title>
    <link href="C:\xampp\htdocs\PawsitiveSAD\images\download (3).jpeg" rel="stylesheet">
    <link rel="stylesheet" href="style_marketplace.css">
</head>
<body>
   
    <!-- Marketplace Section -->
    <main>
   <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
      <h1>Welcome Pawsitive Marketplace</h1>
   </div>
        <!-- Category Filter -->
        <div class="filter">
            <a href="marketplace.php?category=all" class="<?= $category == 'all' ? 'active' : '' ?>">All</a>
            <a href="marketplace.php?category=food" class="<?= $category == 'food' ? 'active' : '' ?>">Pet Food</a>
            <a href="marketplace.php?category=medicine" class="<?= $category == 'medicine' ? 'active' : '' ?>">Pet Medicine</a>
            <a href="find-a-pet.php?category=pet" class="<?= $category == 'pet' ? 'active' : '' ?>">Breeded Pets</a>

        </div>

        <!-- Product Listing -->
        <section class="products">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <img src='{$row['image_url']}' alt='{$row['product_name']}'>
                            <h2>{$row['product_name']}</h2>
                            <p>{$row['description']}</p>
                            <p class='price'>Price: \${$row['price']}</p>
                            <form method='POST' action='add_to_cart.php'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='hidden' name='product_name' value='{$row['product_name']}'>
                                <input type='hidden' name='price' value='{$row['price']}'>
                                <button type='submit'>Add to Cart</button>
                            </form>
                          </div>";
                }                
            } else {
                echo "<p>No products found in this category.</p>";
            }
            ?>
        </section>
    </main>

    <body>
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

<?php $conn->close(); ?>
