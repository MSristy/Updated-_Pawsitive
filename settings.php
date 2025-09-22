<?php
session_start();

// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_admin'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $name = $_POST['name'];

    // Check if passwords match
    if ($admin_password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if the email already exists
        $stmt = $conn->prepare('SELECT * FROM admins WHERE admin_email = ?');
        $stmt->bind_param('s', $admin_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Email already exists.';
        } else {
            // Password hash and insert into admins table
            $admin_password_hash = password_hash($admin_password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare('INSERT INTO admins (admin_email, admin_password, role, name) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $admin_email, $admin_password_hash, $role, $name);

            if ($stmt->execute()) {
                $success = 'Admin registration successful!';
            } else {
                $error = 'Error: ' . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #2c3e50;
            overflow: hidden;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 10;
            padding: 6px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .navbar ul li {
            display: inline-block;
        }

        .navbar ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #575757;
        }

        .form-container {
            padding: 60px 20px;
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .form-group label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        .form-container .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-container .form-group input:focus {
            outline: none;
            border-color: #777;
        }

        .form-container button {
            background-color: #5cb85c;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #4cae4c;
        }

        p[style="color: red;"] {
            text-align: center;
            font-weight: bold;
            color: #e74c3c;
        }

        p[style="color: green;"] {
            text-align: center;
            font-weight: bold;
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="admin_home.php">Dashboard</a></li>
            <li><a href="admin_adoption.php">Available Pets</a></li>
            <li><a href="admin_rehomers.php">Available Rehomers</a></li>
            <li><a href="admin_blog.php">Blogs</a></li>
            <li><a href="admin_vet.php">Vet Appointments</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="form-container">
        <h2>Register New Admin</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="admin_registration.php" method="POST">
            <div class="form-group">
                <label for="admin_email">Email:</label>
                <input type="email" id="admin_email" name="admin_email" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit" name="register_admin">Register Admin</button>
        </form>
    </div>
</body>
</html>
