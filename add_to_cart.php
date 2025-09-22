<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    header("Location: marketplace.php");
    exit;
}
?>