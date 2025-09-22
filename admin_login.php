<?php
session_start();
include('db_connect.php');

if (isset($_POST['login'])) {
    $admin_email = trim($_POST['admin_email']);
    $admin_password = trim($_POST['admin_password']);
    $md5password = md5($admin_password);

    // Validate admin credentials
    $query = "SELECT * FROM admins WHERE admin_email = ? AND admin_password = ? AND role = 'Admin'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_email, $md5password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        // Redirect to admin dashboard
        header("Location: admin_home.php");
        exit();
    } else {
        $errormsg = "Invalid credentials or not an admin!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
    background: url('images/login.jpg') no-repeat center top; /* Align image to the top center */
    background-size: cover; /* Cover the full width and height of the screen */
    background-attachment: fixed; /* Keep the image fixed during scrolling */
    display: flex;
    align-items: flex-start; /* Align items to the top of the page */
    justify-content: flex-start; /* Align items to the left of the page */
    height: 100vh;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}


       .login-box {

    background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
/*    background-color: #FFA500;*/
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    max-width: 700px;
    width: 100%;
    margin-left: 10%; /* Shift the form 10% left from the center */
    margin-top: 15%; /* Add top margin for vertical alignment */
}


        .btn-primary {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-primary:hover {
            background-color: #1c6ea4;
        }

        .text-danger {
            color: #e74c3c;
        }

        .form-footer {
            text-align: center;
            margin-top: 15px;
        }

        .form-footer a {
            text-decoration: none;
            color: #2980b9;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center">Admin Login</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="admin_email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="admin_email" placeholder="Admin Email" required>
            </div>
            <div class="mb-3">
                <label for="admin_password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            <div class="text-danger mt-3"><?php echo isset($errormsg) ? $errormsg : ''; ?></div>
        </form>
        <div class="form-footer">
            Login as a User? <a href="login.php">User LogIn</a>
        </div>
    </div>
</body>
</html>
