<?php
session_start();

// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Fetch vet details using vet_id from URL
$vetId = $_GET['vet_id'] ?? null;
$vet = null;
if ($vetId) {
    $stmt = $conn->prepare("SELECT * FROM vets WHERE id = :id");
    $stmt->execute(['id' => $vetId]);
    $vet = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Initialize appointment message variable
$appointmentMessage = null;

// Handle appointment booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['user_name'];
    $email = $_POST['email'];
    $petName = $_POST['pet_name'];
    $appointmentDate = $_POST['appointment_date'];
    $timeSlot = $_POST['time_slot'];
    $contactInfo = $_POST['contact_info'];

    $stmt = $conn->prepare("INSERT INTO vet_appointments (user_name, email, pet_name, appointment_date, time_slot, contact_info, status)
                        VALUES (:user_name, :email, :pet_name, :appointment_date, :time_slot, :contact_info, 'pending')");
    $stmt->execute([
        'user_name' => $userName,
        'email' => $email,
        'pet_name' => $petName,
        'appointment_date' => $appointmentDate,
        'time_slot' => $timeSlot,
        'contact_info' => $contactInfo
    ]);

    // Set the appointment success message
    $appointmentMessage = "Appointment successfully booked. Await admin approval.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right,rgb(219, 221, 229),rgb(201, 203, 208)); /* Soft gradient background */
            margin: 0;
            padding: 0;
            color: #333;
        }

        .appointment-page {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        form input, form select, form button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            background-color: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #2ecc71;
        }

        .vet-info {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .status-message {
            text-align: center;
            color: green;
            font-weight: bold;
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <div class="appointment-page">
        <?php if ($appointmentMessage): ?>
            <div class="status-message">
                <?= $appointmentMessage; ?>
            </div>
        <?php endif; ?>
        
        <h1>Book Appointment</h1>

        <?php if ($vet): ?>
            <div class="vet-info">
                <h2>Dr. <?= $vet['name']; ?></h2>
                <p><b>Specialization:</b> <?= $vet['specialization']; ?></p>
                <p><b>Experience:</b> <?= $vet['experience']; ?> years</p>
                <p><b>Contact:</b> <?= $vet['contact']; ?></p>
            </div>

            <!-- Appointment form -->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="email" name="email" id="email" placeholder="Your Email" style="color: #333;" required>
                <input type="text" name="user_name" id="user_name" placeholder="Your Name" required>
                <input type="text" name="pet_name" id="pet_name" placeholder="Pet Name" required>
                <input type="date" name="appointment_date" min="<?= date('Y-m-d') ?>" required>
                <select name="time_slot" required>
                    <option value="" disabled selected>Select a Time Slot</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                </select>
                <input type="tel" id="contact_info" name="contact_info" placeholder="Contact Info" pattern="\d{11}" title="Phone number must be exactly 11 digits" required>
                <button type="submit">Book Appointment</button>
            </form>
        <?php else: ?>
            <p>Invalid veterinarian selected. Please go back and select a valid veterinarian.</p>
        <?php endif; ?>
    </div>

    <?php include('templates/footer.php'); ?>

</body>
</html>
