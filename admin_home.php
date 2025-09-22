<?php
include 'db_connect.php';  // Ensure to include database connection
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to Admin Login if not logged in as admin
    header("Location: admin_login.php");
    exit();
}

// Query for dynamic content
$adoption_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM adopters"));
$rehomers_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM rehomers_application"));
$blogs_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM user_posts"));
$vet_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM vet_appointments"));

// Add error checks for queries that could return null or not execute properly
$payment_count_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM payment");
$payment_count = ($payment_count_result) ? mysqli_fetch_assoc($payment_count_result) : ['count' => 0];

$report_count_result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM reports");
$report_count = ($report_count_result) ? mysqli_fetch_assoc($report_count_result) : ['count' => 0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsitive - Dashboard</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
           background-color: #2d3a47;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 5px 0;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #2d3a47;
        }

        .top-bar {
            height: 60px;
            background-color: #003366; /* Deep Blue */
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            margin-left: 250px;
        }

        .top-bar .logout {
            background-color: #ff4b5c;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
        }

        .main h1 {
            font-weight: bold;
            color: #2c2c2c;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .card h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card .view-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
        }

        .card .view-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .top-bar {
                margin-left: 0;
            }

            .main {
                margin-left: 0;
            }

            .card-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Pawsitive</h2>
        <a href="admin_adoption.php"><i class="fas fa-paw"></i> Adoption</a>
        <a href="admin_rehomers.php"><i class="fas fa-undo-alt"></i> Rehomers</a>
        <a href="admin_blog.php"><i class="fas fa-pen-square"></i> Blogs</a>
        <a href="admin_vet.php"><i class="fas fa-stethoscope"></i> Veterinary</a>
        <a href="payment.php"><i class="fas fa-credit-card"></i> Payments</a>
        <a href="reports.php"><i class="fas fa-file-alt"></i> Reports</a>
        <a href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
    </div>

    <div class="top-bar">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <?php else: ?>
            <span>Welcome Guest</span>
        <?php endif; ?>
        <button class="logout" onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <div class="main">
        <h1> Admin Dashboard</h1>
        <div class="card-container">
            <div class="card" style="background-color: #4CAF50;">
                <h2><i class="fas fa-paw"></i> Adoption</h2>
                <p>Adopted: <?php echo $adoption_count['count']; ?></p>
                <a href="admin_adoption.php" class="view-button">View Adoption</a>
            </div>
            <div class="card" style="background-color: #FF9800;">
                <h2><i class="fas fa-undo-alt"></i> Rehomers</h2>
                <p>Rehomed: <?php echo $rehomers_count['count']; ?></p>
                <a href="admin_rehomers.php" class="view-button">View Rehomers</a>
            </div>
            <div class="card" style="background-color: #2196F3;">
                <h2><i class="fas fa-pen-square"></i> Blogs</h2>
                <p>Blogs Published: <?php echo $blogs_count['count']; ?></p>
                <a href="admin_blog.php" class="view-button">View Blogs</a>
            </div>
            <div class="card" style="background-color: #9C27B0;">
                <h2><i class="fas fa-stethoscope"></i> Veterinary</h2>
                <p>Veterinary Services: <?php echo $vet_count['count']; ?></p>
                <a href="admin_vet.php" class="view-button">View Veterinary</a>
            </div>
            <!-- <div class="card" style="background-color: #F44336;">
                <h2><i class="fas fa-credit-card"></i> Payments</h2>
                <p>Payments: <?php echo $payment_count['count']; ?></p>
                <a href="payment.php" class="view-button">View Payments</a>
            </div>
            <div class="card" style="background-color: #FFC107;">
                <h2><i class="fas fa-file-alt"></i> Reports</h2>
                <p>Reports: <?php echo $report_count['count']; ?></p>
                <a href="reports.php" class="view-button">View Reports</a>
            </div> -->
        </div>
    </div>

</body>
</html>

<script>
// Dynamic cart functionality to show pending items for admin view
document.addEventListener('DOMContentLoaded', function() {
    var role = '<?php echo $_SESSION['role']; ?>'; // Get user role (admin/user) from session

    if (role === 'admin') {
        // Example: Admin sees pending items
        var pending_items = <?php echo $conn->query("SELECT * FROM adoption WHERE status='pending'")->num_rows; ?>;
        document.querySelector('.adoption-card p').innerHTML = '<b>' + pending_items + '</b>';
    }
});
</script>
