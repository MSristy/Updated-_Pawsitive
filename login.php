<?php
session_start();
include('db_connect.php');

$unsuccessfulmsg = '';

// Check if user is already logged in
if (isset($_SESSION['email'])) {
    header('Location: index.php'); // Redirect to user homepage if already logged in
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordmd5 = md5($password);

    $emailmsg = empty($email) ? 'Enter an Email.' : '';
    $passmsg = empty($password) ? 'Enter your Password.' : '';

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$passwordmd5'";
        $query = $conn->query($sql);

        if ($query && $query->num_rows > 0) {
            $row = $query->fetch_assoc();

            // Store user data in session
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $email; // Correct variable
            $_SESSION['name'] = $row['first_name'] . ' ' . $row['last_name'];

            // Redirect to index page
            header('Location: index.php');
            exit();
        } else {
            $unsuccessfulmsg = 'Wrong Email or Password!!';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('images/login.jpg') no-repeat center top;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            height: 100vh;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            width: 700px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            margin-left: 10%;
            margin-top: 14%;
        }
        h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            float: left;
        }
        .form-control {
            border-radius: 20px;
            border: 1.5px solid #ddd;
            padding-left: 20px;
            font-size: 16px;
            height: 50px;
            margin-bottom: 15px;
        }
        .form-control:focus {
            border-color: #3faffa;
            box-shadow: 0 0 8px rgba(63, 250, 255, 0.5);
            outline: none;
        }
        .btn-custom {
            background-color: #3faffa;
            border: none;
            border-radius: 20px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            padding: 12px;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: #5ab4ff;
        }
        .form-footer {
            margin-top: 20px;
            font-size: 14px;
        }
        .form-footer a {
            color: #3faffa;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }
        .form-footer a:hover {
            color: #a8c0ff;
        }
        .text-danger, .text-success {
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>User Login</h2>
        <p class="text-success"><?php if (!empty($_SESSION['signupmsg'])) { echo $_SESSION['signupmsg']; unset($_SESSION['signupmsg']); } ?></p>
        <p class="text-danger"><?php echo $unsuccessfulmsg; ?></p>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your Email" value="<?php if (isset($_POST['submit'])) { echo htmlspecialchars($email); } ?>">
                <span class="text-danger"><?php if (isset($_POST['submit'])) { echo $emailmsg; } ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your Password">
                <span class="text-danger"><?php if (isset($_POST['submit'])) { echo $passmsg; } ?></span>
            </div>
            <button type="submit" name="submit" class="btn btn-custom">Login</button>
            <div class="form-footer">
                Don't have an Account Yet? <a href="signup.php">Sign Up</a><br>
                Login as an Admin? <a href="admin_login.php">Admin LogIn</a>
            </div>
        </form>
    </div>
</body>
</html>










