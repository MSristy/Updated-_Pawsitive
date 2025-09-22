<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to Admin Login if not logged in as admin
    header("Location: admin_login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paw";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval action
if (isset($_POST['approve'])) {
    $adopter_id = $conn->real_escape_string($_POST['a_id']);
    $adoption_date = $_POST['adoption_date'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $certificate_number = uniqid('CERT_');

    // Update adopter status to approved
    $sql = "UPDATE adopters SET status = 'approved' WHERE a_id = '$adopter_id'";

    if ($conn->query($sql) === TRUE) {
        $sql_certificate = "INSERT INTO certificates (date_of_issue, adopter_email, certificate_number)
                            VALUES ('$adoption_date', '$email', '$certificate_number')";

        if ($conn->query($sql_certificate) === TRUE) {
            echo "<script>alert('Adoption approved and certificate issued successfully!');</script>";
        } else {
            echo "<script>alert('Error generating certificate: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
    }
}

// Fetch all adopters with their status
$sql = "SELECT * FROM adopters";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Approve Adoptions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="admin_adopters.css">

    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Top Bar Styles */
        .top-bar {
            background-color: #003366; /* Deep Blue */
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h1 {
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info span {
            margin-right: 20px;
        }

        .user-info a {
            color: #fff;
            text-decoration: none;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #2d3a47;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar .project-name {
            font-size: 1.5rem;
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #3e4a58;
        }

        /* Content Styles */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .content h2 {
            color: #333;
        }

        .adoption-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .adoption-table th, .adoption-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .adoption-table th {
            background-color: #003366; /* Deep Blue */
            color: #fff;
        }

        .adoption-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .adoption-table .approved-tag {
            color: green;
            font-weight: bold;
        }

        .adoption-table .pending-tag {
            color: orange;
            font-weight: bold;
        }

        .approve-btn {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .approve-btn:hover {
            background-color: #218838;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }

            .content {
                margin-left: 200px;
            }

            .top-bar h1 {
                font-size: 1.2rem;
            }
        }
    </style>

</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <h1>Dashboard</h1>
        <div class="user-info">
            <span>Welcome, Admin</span>
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="project-name">Pawsitive</div>
        <ul>
            <li><a href="admin_home.php"><i class="fas fa-home"></i> Admin Home</a></li>
            <li><a href="admin_adoption.php" class="active"><i class="fas fa-paw"></i> Adoption</a></li>
            <li><a href="admin_users.php"><i class="fas fa-users"></i> Admin Home</a></li>
            <li><a href="admin_pets.php"><i class="fas fa-pet"></i> Pets</a></li>
            <li><a href="admin_reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Adoption Requests</h2>

        <table class="adoption-table">
            <thead>
                <tr>
                    <th>Adopter ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Adoption Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['a_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['adoption_date']; ?></td>
                    <td>
                        <?php if ($row['status'] === 'approved'): ?>
                            <span class="approved-tag">Approved</span>
                        <?php else: ?>
                            <span class="pending-tag">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row['status'] !== 'approved'): ?>
                            <form method="POST" action="">
                                <input type="hidden" name="a_id" value="<?php echo $row['a_id']; ?>">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                <input type="hidden" name="phone" value="<?php echo $row['phone_number']; ?>">
                                <input type="hidden" name="adoption_date" value="<?php echo $row['adoption_date']; ?>">
                                <button type="submit" name="approve" class="approve-btn">Approve</button>
                            </form>
                        <?php else: ?>
                            <span>Already Approved</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
