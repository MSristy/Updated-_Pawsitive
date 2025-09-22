<?php
session_start();
include('db_connect.php');

// Initialize error messages
$emptymsg1 = $emptymsg2 = $emptymsg3 = $emptymsg4 = $emptymsg5 = $pasmatchmsg = $errormsg = '';
$first_name = $last_name = $email = ''; // Initialize form fields to avoid undefined variable warnings

if (isset($_POST['submit'])) {
    $first_name = trim($_POST['users_first_name']);
    $last_name = trim($_POST['users_last_name']);
    $email = trim($_POST['users_email']);
    $password = trim($_POST['users_password']);
    $passwordagain = trim($_POST['passwordagain']);

    // Hash the password
    $md5password = md5($password);

    // Check for empty fields
    if (empty($first_name)) {
        $emptymsg1 = 'Write Firstname';
    }
    if (empty($last_name)) {
        $emptymsg2 = 'Write Lastname';
    }
    if (empty($email)) {
        $emptymsg3 = 'Write email';
    }
    if (empty($password)) {
        $emptymsg4 = 'Write password';
    }
    if (empty($passwordagain)) {
        $emptymsg5 = 'Write password Again';
    }

    // Proceed if all fields are filled
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($passwordagain)) {
        if ($password !== $passwordagain) {
            $pasmatchmsg = 'Password does not match!';
        } else {
            // Check if email already exists
            $check_email_query = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($check_email_query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $errormsg = 'This email is already registered. Please use another email.';
            } else {
                // Insert data into the database
                $sql = "INSERT INTO users (name, email, password, users_first_name, users_last_name) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $name = $first_name . " " . $last_name; // Combine first and last name
                $stmt->bind_param("sssss", $name, $email, $md5password, $first_name, $last_name);

                if ($stmt->execute()) {
                    $_SESSION['signupmsg'] = 'Sign Up Complete. Please Log in now.';
                    header('location:login.php');
                    exit();
                } else {
                    $errormsg = 'Error inserting data: ' . $conn->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

              .login-container {
            background: rgba(255, 255, 255, 0.9);
            width: 600px; /* Reduced width for smaller form */
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 60px;
            text-align: center;
            margin-left: -10%; /* Move form further left */
            margin-top: 18%; /* Adjust top margin for better vertical alignment */
        }


        h3 {
            color: #3498db;
        }

        .bg-light {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #dcdcdc;
        }

        label {
            display: none; /* Hide label */
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 16px;
            background-color: #f0f8ff;
            border: 2px solid #3498db;
        }

        .form-control:focus {
            border-color: #2980b9;
            box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
        }

        .btn-success {
            background-color: #2ecc71;
            border-color: #27ae60;
            border-radius: 30px;
            padding: 12px;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-success:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }

        .text-danger {
            color: #e74c3c;
            font-size: 14px;
        }

        .text-decoration-none {
            color: #3498db;
            font-weight: bold;
        }

        .text-decoration-none:hover {
            color: #2980b9;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="bg-light p-4 login-container">
            <h3 class="text-center">Sign Up Form</h3>
            <form action="" method="POST">
                <div class="mt-2 pb-2">
                    <input type="text" name="users_first_name" class="form-control" placeholder="Your First Name" value="<?php echo htmlspecialchars($first_name); ?>">
                    <span class="text-danger"><?php echo $emptymsg1; ?></span>
                </div>
                <div class="mt-2 pb-2">
                    <input type="text" name="users_last_name" class="form-control" placeholder="Your Last Name" value="<?php echo htmlspecialchars($last_name); ?>">
                    <span class="text-danger"><?php echo $emptymsg2; ?></span>
                </div>
                <div class="mt-2 pb-2">
                    <input type="email" name="users_email" class="form-control" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email); ?>">
                    <span class="text-danger"><?php echo $emptymsg3; ?></span>
                </div>
                <div class="mt-1 pb-2">
                    <input type="password" name="users_password" class="form-control" placeholder="Enter New Password">
                    <span class="text-danger"><?php echo $emptymsg4; ?></span>
                </div>
                <div class="mt-1 pb-2">
                    <input type="password" name="passwordagain" class="form-control" placeholder="Enter password Again">
                    <span class="text-danger"><?php echo $emptymsg5 . $pasmatchmsg; ?></span>
                </div>
                <div class="mt-1 pb-2">
                    <button name="submit" class="btn btn-success">Sign Up</button>
                </div>
                <div class="mt-1 pb-2">
                    Already have an account? <a href="login.php" class="text-decoration-none">Login</a>
                </div>
                <div class="text-danger"><?php echo $errormsg; ?></div>
            </form>
        </div>
    </div>
</body>
</html>
