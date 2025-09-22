<?php
// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Function to send an email notification to the user
function sendNotification($userEmail, $appointmentId) {
    $subject = "Appointment Request Approved";
    $message = "Dear User,\n\nYour appointment request has been approved. Thank you for choosing our veterinary services!\n\nBest regards,\nPawsitive Team";
    $headers = "From: no-reply@pawsitive.com";

    // Send email
    if (mail($userEmail, $subject, $message, $headers)) {
        saveNotification($appointmentId, $userEmail); // Save notification in DB
        return true;
    } else {
        return false;
    }
}

// Function to save notification in the database
function saveNotification($appointmentId, $userEmail) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO notifications (appointment_id, user_email) VALUES (:appointment_id, :user_email)");
    $stmt->execute([
        'appointment_id' => $appointmentId,
        'user_email' => $userEmail
    ]);
}

// Fetch pending and confirmed appointments
$stmt = $conn->query("SELECT * FROM vet_appointments WHERE status IN ('pending', 'confirmed')");
$appointments = $stmt->fetchAll();

// Handle admin approval
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    $appointmentId = $_POST['appointment_id'];
    $userEmail = $_POST['user_email'];

    // Update appointment status
    $stmt = $conn->prepare("UPDATE vet_appointments SET status = 'confirmed' WHERE id = :appointment_id");
    $stmt->execute(['appointment_id' => $appointmentId]);

    // Send notification
    if (sendNotification($userEmail, $appointmentId)) {
        echo "<script>alert('Appointment approved and notification sent!');</script>";
    } else {
        echo "<script>alert('Failed to send notification.');</script>";
    }

    // Refresh page after approval
    header("Location: admin_vet.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Veterinary Appointments</title>
    <style>
        /* General Page Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .topbar {
            background-color: #003366; /* Deep Blue */
            color: white;
            padding: 20px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .logo {
            font-size: 24px;
        }

        .topbar .user-info a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        button {
            padding: 10px 20px;
            background-color: #2ecc71;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #27ae60;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="topbar">
        <div class="logo">Pawsitive</div>
        <div class="user-info">
            <span>Welcome, Admin</span>
            <a href="profile.php">Profile</a>
        </div>
    </div>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Pawsitive Admin</h2>
            <ul>
                <li><a href="admin_home.php">Admin Home</a></li>
                <li><a href="admin_vet.php">Veterinary Appointments</a></li>
                <li><a href="admin_users.php">Manage Users</a></li>
                <li><a href="admin_pets.php">Manage Pets</a></li>
                <li><a href="admin_messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Manage Veterinary Appointments</h1>

            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Pet Name</th>
                        <th>Appointment Date</th>
                        <th>Contact Info</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['user_name']); ?></td>
                            <td><?= htmlspecialchars($appointment['pet_name']); ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($appointment['contact_info']); ?></td>
                            <td>
                                <?= htmlspecialchars($appointment['status'] === 'confirmed' ? 'Confirmed' : 'Pending'); ?>
                            </td>
                            <td>
                                <?php if ($appointment['status'] === 'pending'): ?>
                                    <form method="POST">
                                        <input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
                                        <input type="hidden" name="user_email" value="<?= $appointment['contact_info']; ?>">
                                        <button type="submit" name="confirm">Confirm</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
