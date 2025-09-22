<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$id])) {
        switch ($action) {
            case 'increase':
                $_SESSION['cart'][$id]['quantity'] += 1;
                break;

            case 'decrease':
                if ($_SESSION['cart'][$id]['quantity'] > 1) {
                    $_SESSION['cart'][$id]['quantity'] -= 1;
                } else {
                    unset($_SESSION['cart'][$id]);
                }
                break;

            case 'remove':
                unset($_SESSION['cart'][$id]);
                break;
        }
    }
}

header("Location: cart.php");
exit;
?>
