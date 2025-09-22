<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to Admin Login if not logged in as admin
    header("Location: admin_login.php");
    exit();
}

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'paw';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval action for rehomers
if (isset($_GET['approve_rehomers_id'])) {
    $approve_id = intval($_GET['approve_rehomers_id']);
    $sql = "UPDATE rehomers_application SET approved = 1 WHERE id = $approve_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Rehomers application approved successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Handle approval action for temporary housing
if (isset($_GET['approve_temp_id'])) {
    $approve_id = intval($_GET['approve_temp_id']);
    $sql = "UPDATE temporary_housing SET approved = 1 WHERE id = $approve_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Temporary housing request approved successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Fetch all rehomers applications from the database
$sql_rehomers = "SELECT * FROM rehomers_application ORDER BY approved ASC";
$result_rehomers = $conn->query($sql_rehomers);

// Fetch all temporary housing requests from the database
$sql_temporary = "SELECT * FROM temporary_housing ORDER BY approved ASC";
$result_temporary = $conn->query($sql_temporary);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehomers Management - Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <style>
        /* Sidebar Style */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2d3a47;
                        height: 100%;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background-color: #5f8fbd;
            border-radius: 4px;
        }

         .top-bar {
            height: 70px;
            background-color: #003366; /* Deep Blue */
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            margin-left: 220px;
        }

        .top-bar .logout {
            background-color: #ff4b5c;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Main Content */
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td img {
            border-radius: 8px;
            max-width: 100px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Pawsitive</h2>
        <a href="admin_home.php">Admin Home</a>
        <a href="admin_rehomers.php">Rehomers</a>
        <a href="admin_temporary.php">Temporary Housing</a>
        <a href="admin_logout.php">Logout</a>
    </div>

     <div class="top-bar">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <?php else: ?>
            <span>Welcome to Rehomers</span>
        <?php endif; ?>
        <button class="logout" onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Rehomers Applications</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Pet Choice</th>
                <th>Pet Age</th>
                <th>Pet Picture</th>
                <th>Approval Status</th>
                <th>Actions</th>
            </tr>

            <?php if ($result_rehomers->num_rows > 0): ?>
                <?php while ($row = $result_rehomers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_choice']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_age']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['pet_picture']); ?>" alt="Pet Picture"></td>
                        <td><?php echo $row['approved'] ? 'Approved' : 'Pending'; ?></td>
                        <td>
                            <?php if (!$row['approved']): ?>
                                <a class="btn-approve" href="admin_rehomers.php?approve_rehomers_id=<?php echo intval($row['id']); ?>">Approve</a>
                            <?php else: ?>
                                Already Approved
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">No rehomers applications found.</td></tr>
            <?php endif; ?>
        </table>

        <h2>Temporary Housing Requests</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Pet Type</th>
                <th>Pet Name</th>
                <th>Pet Breed</th>
                <th>Pet Age</th>
                <th>Health Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Pet Picture</th>
                <th>Approval Status</th>
                <th>Actions</th>
            </tr>

            <?php if ($result_temporary->num_rows > 0): ?>
                <?php while ($row = $result_temporary->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_breed']); ?></td>
                        <td><?php echo htmlspecialchars($row['pet_age']); ?></td>
                        <td><?php echo htmlspecialchars($row['health_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['reason']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['pet_picture']); ?>" alt="Pet Picture"></td>
                        <td><?php echo $row['approved'] ? 'Approved' : 'Pending'; ?></td>
                        <td>
                            <?php if (!$row['approved']): ?>
                                <a class="btn-approve" href="admin_rehomers.php?approve_temp_id=<?php echo intval($row['id']); ?>">Approve</a>
                            <?php else: ?>
                                Already Approved
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="15">No temporary housing requests found.</td></tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
