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

$successMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phoneNumber']); // Updated key to match form
    $address = $conn->real_escape_string($_POST['address']);
    $pet_type = $conn->real_escape_string($_POST['pet_type']);
    $pet_name = $conn->real_escape_string($_POST['pet_name']);
    $pet_age = $conn->real_escape_string($_POST['pet_age']);
    $health_status = $conn->real_escape_string($_POST['health_status']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $reason = $conn->real_escape_string($_POST['reason']);

    // Handling file upload for pet picture
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["pet_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is valid
    $check = getimagesize($_FILES["pet_picture"]["tmp_name"]);
    if ($check !== false && move_uploaded_file($_FILES["pet_picture"]["tmp_name"], $target_file)) {
        // Insert form data into the database
        $sql = "INSERT INTO temporary_housing (name, email, phone, address, pet_type, pet_name, pet_age, health_status, start_date, end_date, reason, pet_picture) 
                VALUES ('$name', '$email', '$phone', '$address', '$pet_type', '$pet_name', '$pet_age', '$health_status', '$start_date', '$end_date', '$reason', '$target_file')";

     // Your existing logic for submitting the form or handling the file upload
    if ($conn->query($sql) === TRUE) {
        $successMessage = "<p class='message' style='color: green; font-weight: bold;'>Temporary housing application submitted successfully! Waiting for Approval.</p>";
    } else {
        $successMessage = "<p class='message' style='color: red; font-weight: bold;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
} else {
    $successMessage = "<p class='message' style='color: red; font-weight: bold;'>File upload error.</p>";
}
}

$conn->close();
?>

<!-- HTML Form for Temporary Housing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Housing Application</title>
    <style>
        /* General reset for styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 


        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right,rgb(248, 248, 251),rgb(227, 229, 233));
            color: #333;
            line-height: 1.6;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #4CAF50;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid red;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        textarea:focus,
        select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.6);
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="submit"]:active {
            background-color: #388e3c;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            input[type="submit"] {
                font-size: 1rem;
            }

            label {
                font-size: 0.9rem;
            }
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-top: 40px;
        }

.message {
    position: relative;
    top: 20px; /* Adjust this value to position it closer to the form */
    margin: 0 auto;
    font-size: 1.2rem;
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.9);
    border: 2px solid #ccc;
    border-radius: 10px;
    text-align: center;
    max-width: 500px;
    width: 100%;
    z-index: 10;
}


    </style>
</head>
<body>

    <?php include('templates/header.php'); ?>
     <!-- Displaying the success or error message -->
    <?= isset($successMessage) ? $successMessage : ''; ?>
   
   <div class="temp-house">
       <h2>Temporary Housing Application</h2>

    

    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Adopter's Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" style="color: #333;" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" 
               pattern="\d{11}" title="Phone number must be exactly 11 digits" required>

        <label for="address">Home Address:</label>
        <textarea id="address" name="address" rows="3" required></textarea>

        <label for="pet_type">Pet Type:</label>
        <select id="pet_type" name="pet_type" required>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="bird">Bird</option>
        </select>

        <label for="pet_name">Pet Name:</label>
        <input type="text" id="pet_name" name="pet_name" required>

        <label for="pet_age">Pet Age:</label>
        <input type="text" id="pet_age" name="pet_age" required>

        <label for="health_status">Pet Health Status:</label>
        <textarea id="health_status" name="health_status" rows="2"></textarea>

        <label for="pet_picture">Upload Pet Picture:</label>
        <input type="file" id="pet_picture" name="pet_picture" accept="image/*" required>

        <label for="start_date">Preferred Start Date:</label>
        <input type="date" id="start_date" name="start_date" min="<?= date('Y-m-d') ?>" required>

        <label for="end_date">Preferred End Date:</label>
        <input type="date" id="end_date" name="end_date" min="<?= date('Y-m-d') ?>" required>

        <label for="reason">Reason for Temporary Housing:</label>
        <textarea id="reason" name="reason" rows="4" required></textarea>

        <input type="submit" value="Submit Temporary Housing Application">
    </form>


   </div>
    
    <?php include('templates/footer.php'); ?>
</body>
</html>
