<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'paw';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pet_choice = $_POST['pet_choice'];
    $pet_age = $_POST['pet_age'];
    $pet_picture = $_FILES['pet_picture'];

   // Save pet picture
$target_dir = "images/";
$target_file = $target_dir . basename($pet_picture["name"]);

// Check if the uploads directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
}


    // Insert into database
    $stmt = $conn->prepare("INSERT INTO rehomers_application (name, email, phone, pet_choice, pet_age, pet_picture, approved) VALUES (?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $pet_choice, $pet_age, $target_file);

    if ($stmt->execute()) {
        $success_message = "Form submitted successfully! Wait for admin approval.";
    } else {
        $success_message = "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehomers Application</title>
     
<style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right,rgb(228, 230, 234),rgb(212, 214, 221)); /* Soft gradient background */
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 28px;
            color: #333;
            font-weight: bold;
        }

        /* Styling for the form container to center it on the page */
        .rehomers-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px); /* Full height minus the header and footer space */
            margin: 0;
        }

        /* Form box styling with red border */
        .form-box {
            width: 100%;
            max-width: 600px;
            padding: 40px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            border: 2px solid red; /* Red border for the form */
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            background: linear-gradient(to bottom right, #ffffff, #f3f4f9);
        }

        /* Hover effect on form box */
        .form-box:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px); /* Slight upward movement */
        }

        /* Styling for labels */
        .form-box label {
            display: block;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #444;
            transition: color 0.3s ease;
        }

        /* Focus effect for labels */
        .form-box input[type="text"]:focus + label,
        .form-box input[type="email"]:focus + label,
        .form-box select:focus + label {
            color: #4CAF50;
        }

        /* Styling for input fields */
        .form-box input[type="text"],
        .form-box input[type="email"],
        .form-box input[type="file"],
        .form-box select {
            width: 100%;
            padding: 14px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background-color: #f9f9f9;
        }

        /* Focus effect for input fields (red border on focus) */
        .form-box input[type="text"]:focus,
        .form-box input[type="email"]:focus,
        .form-box select:focus {
            border-color: red; /* Red border on focus */
            outline: none;
            background-color: #fff;
        }

        /* Submit button styling */
        .form-box input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-box input[type="submit"]:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Responsive styling for smaller screens */
        @media screen and (max-width: 600px) {
            .form-box {
                width: 90%;
                padding: 20px;
            }
        }


        .message {
            text-align: center;
            margin: 10px auto;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            max-width: 500px;
        }
        .success {
            background-color: #4CAF50; /* Green for success */
        }
        .error {
            background-color: #f44336; /* Red for error */
        }

    </style>



    <!-- Add your existing CSS and header here -->
</head>
<body>
    <?php include('templates/header.php'); ?>
    <h2>Rehomers Application</h2>

    <?php if (!empty($success_message)): ?>
        <div class="message <?php echo strpos($success_message, 'Error') === false ? 'success' : 'error'; ?>">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>


    <div class="rehomers-form-container">
        <form class="form-box" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" style="color: #333;" required>


            <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber"  
                           pattern="\d{11}" title="Phone number must be exactly 11 digits" required>


            <label for="pet_choice">Pet Choice:</label>
            <select id="pet_choice" name="pet_choice" required>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="bird">Bird</option>
            </select>
            <label for="pet_age">Pet Age:</label>
            <input type="text" id="pet_age" name="pet_age" required>
            <label for="pet_picture">Upload Pet Picture:</label>
            <input type="file" id="pet_picture" name="pet_picture" accept="images/*" required>
            <input type="submit" value="Submit Application">
        </form>
    </div>
    <?php include('templates/footer.php'); ?>
</body>
</html>










