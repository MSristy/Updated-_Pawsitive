<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paw";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $phone_number = $email = $preference = $adoption_date = $experience = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : null;
    $phone_number = isset($_POST['phoneNumber']) ? $conn->real_escape_string(trim($_POST['phoneNumber'])) : null;
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null;
    $preference = isset($_POST['preference']) ? $conn->real_escape_string(trim($_POST['preference'])) : null;
    $adoption_date = isset($_POST['adoptionDate']) ? $conn->real_escape_string(trim($_POST['adoptionDate'])) : null;
    $experience = isset($_POST['experience']) ? $conn->real_escape_string(trim($_POST['experience'])) : null;
    $address = isset($_POST['city']) ? $conn->real_escape_string(trim($_POST['city'])) : null;

    // Check for required fields
    if (!$name || !$phone_number || !$email || !$preference || !$adoption_date || !$experience || !$address) {
        echo "<script>alert('Please fill out all required fields.');</script>";
    } else {
        // Check for duplicate email
        $check_email_sql = "SELECT email FROM adopters WHERE email = '$email'";
        $result = $conn->query($check_email_sql);

        if ($result && $result->num_rows > 0) {
            echo "<script>alert('The email address is already registered. Please use a different email.');</script>";
        } else {
            // Insert into adopters table
            $sql = "INSERT INTO adopters (name, phone_number, email, preferences, adoption_date, experience, address)
                    VALUES ('$name', '$phone_number', '$email', '$preference', '$adoption_date', '$experience', '$address')";

            if ($conn->query($sql) === TRUE) {
                // Generate and insert certificate details
                $certificate_number = uniqid('CERT_');
                $sql_certificate = "INSERT INTO certificates (date_of_issue, adopter_email, certificate_number)
                                    VALUES ('$adoption_date', '$email', '$certificate_number')";

                if ($conn->query($sql_certificate) === TRUE) {
                    echo "<script>alert('Your Adoption Request Is Pending!');</script>";
                    echo "<p>Thank you for your application. You will receive a certificate shortly.</p>";
                } else {
                    echo "<script>alert('Error generating certificate: " . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSITIVE Adoption Application</title>
    <!-- <link rel="stylesheet" href="style_adopt.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .pets-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .pet-card {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pet-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .certificate-section {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            border: 1px dashed #007bff;
            border-radius: 8px;
            background-color: #eef7ff;
        }

        .certificate-section h3 {
            margin-bottom: 10px;
            color: #0056b3;
        }

        .error-msg {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        .success-msg {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            button {
                font-size: 14px;
                padding: 8px;
            }
        }


        .full {
            width: 600px;
            background-color: #fae5d9;

        }
    </style>


</head>
<body>
    <?php include('templates/header.php'); ?>

    <main>


    <div style="text-align: center;">
    <h1 style="display: inline-block; margin: 0;">Please Fill Up the Form for Adoption the Pet</h1>
</div>

<div class="page-wrapper">
    <div class="full">  
        <div class="form-container">
            <h2>Adoption Application Form</h2>
            <form id="adoptionForm" method="POST" action="">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Name" required>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter your Phone Number" 
                           pattern="\d{11}" title="Phone number must be exactly 11 digits" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <div class="address-dropdown">
                        <select id="city" name="city" required>
                            <option value="" disabled selected>Select City</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Barishal">Barishal</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rangpur">Rangpur</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" 
                           style="color: #333;" required>
                </div>

                <div class="form-group">
                    <label for="preference">Preference:</label>
                    <select id="preferences" name="preference" required>
                        <option value="" disabled selected>Select Preference</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Exotic Shorthair">Exotic Shorthair</option>
                        <option value="Budgerigar">Budgerigar</option>
                        <option value="Bichon Frise">Bichon Frise</option>
                        <option value="Norwegian Forest Cat">Norwegian Forest Cat</option>
                        <option value="Cockatiel">Cockatiel</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="adoptionDate">Date of Adoption:</label>
                    <input type="date" id="adoption_date" name="adoptionDate" min="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label for="experience">Previous Experience:</label>
                    <textarea id="experience" name="experience" rows="4" placeholder="Describe any previous experience with pets" required></textarea>
                </div>

                <button type="submit">Submit Application</button>
            </form>
        </div>
    </div>
</div>

    </main>

    <?php include('templates/footer.php'); ?>

</body>
</html>
