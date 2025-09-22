<?php
// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Fetch vet profiles
$query = "SELECT * FROM vets";
$vets = $conn->query($query);

// Fetch parks for suggestions
$parkQuery = "SELECT * FROM parks";
$parks = $conn->query($parkQuery);

// Fetch pet competitions
$competitionQuery = "SELECT * FROM competitions";
$competitions = $conn->query($competitionQuery);

// Handle form submission for appointment booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['user_name'];
    $email = $_POST['email']; // Email field
    $petName = $_POST['pet_name'];
    $vetId = $_POST['vet_id'];
    $appointmentDate = $_POST['appointment_date'];
    $timeSlot = $_POST['time_slot']; // Time slot field
    $contactInfo = $_POST['contact_info'];

    // Insert appointment into the database
    $stmt = $conn->prepare("INSERT INTO vet_appointments (user_name, email, pet_name, id, appointment_date, time_slot, contact_info)
                            VALUES (:user_name, :email, :pet_name, :id, :appointment_date, :time_slot, :contact_info)");
    $stmt->execute([
        'user_name' => $userName,
        'email' => $email,
        'pet_name' => $petName,
        'id' => $vetId,
        'appointment_date' => $appointmentDate,
        'time_slot' => $timeSlot,
        'contact_info' => $contactInfo
    ]);

    echo "<script>alert('You have requested for the appointment. If your request is approved, we will notify you.');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .vet-system {
            width: 90%;
            margin: auto;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }

        /* Section styles */
        section {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            padding: 20px;
        }

        /* Veterinary Profiles Section */
        .vet-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .vet-card {
            background-color: #ecf0f1;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .vet-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .vet-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        /* Appointment Form Section */
        .appointment-form input, .appointment-form select, .appointment-form button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .appointment-form button {
            background-color: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .appointment-form button:hover {
            background-color: #2ecc71;
        }

        /* Park Suggestions Section */
        .park-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .park-card {
            background-color: #ecf0f1;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 250px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .park-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .park-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Pet Competitions Section */
        .competition-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .competition-card {
            background-color: #ecf0f1;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .competition-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .competition-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
    

.vet-system h1 {
    
    font-size: 2.2rem;
    color: #e04b45;
    margin-bottom: 25px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    margin-top: -10px;

}

.park-suggestions h2{

    font-size: 2.2rem;
    color: #e04b45;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    margin-top: -10px;


}

.pet-competitions h2{
    font-size: 2.2rem;
    color: #e04b45;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    margin-top: -10px;

}



    </style>
</head>
<body>
<?php include('templates/header.php'); ?>
    <div class="vet-system">
        <!-- Veterinary Profiles -->
        <section class="vet-profiles">
            <h1>Our Veterinarian</h1>
            <div class="vet-container">
                <?php foreach ($vets as $vet): ?>
                    <div class="vet-card">
                        <img src="images/<?= $vet['image']; ?>" alt="Vet Image">
                        <h2><?= $vet['name']; ?></h2>
                        <p><b>Specialization:</b> <?= $vet['specialization']; ?></p>
                        <p><b>Experience:</b> <?= $vet['experience']; ?> years</p>
                        <p><b>Contact:</b> <?= $vet['contact']; ?></p>
                        <button>
    <a href="appointment.php?vet_id=<?= $vet['id']; ?>" style="text-decoration: none; color: inherit;">Book Appointment</a>
</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

       
                        

        <!-- Park Visit Suggestions -->
        <section class="park-suggestions">
            <h2>Suggested Parks Near You</h2>
            <div class="park-container">
                <?php foreach ($parks as $park): ?>
                    <div class="park-card">
                        <img src="images/<?= $park['image']; ?>" alt="<?= $park['name']; ?> Park">
                        <h3><?= $park['name']; ?></h3>
                        <p><a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($park['location']); ?>" target="_blank">
                            <?= $park['location']; ?>
                        </a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Pet Competitions -->
        <section class="pet-competitions">
            <h2>Upcoming Pet Competitions</h2>
            <div class="competition-container">
                <?php foreach ($competitions as $competition): ?>
                    <div class="competition-card">
                        <img src="images/<?= $competition['image']; ?>" alt="<?= $competition['title']; ?> Competition">
                        <div class="competition-info">
                            <h3><?= $competition['title']; ?></h3>
                            <p>Date: <?= $competition['date']; ?></p>
                            <p>Location: <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($competition['location']); ?>" target="_blank"><?= $competition['location']; ?></a></p>
                            <p>Contact: <?= $competition['contact']; ?></p>
                            <a href="competition_info.php?id=<?= $competition['id']; ?>" class="know-more-btn">Know More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <?php include('templates/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#email').on('blur', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: 'fetch_adopter.php',
                        type: 'POST',
                        data: {email: email},
                        success: function(data) {
                            var adopter = JSON.parse(data);
                            if (adopter) {
                                $('#user_name').val(adopter.name);
                                $('#pet_name').val(adopter.pet_name);
                                $('#contact_info').val(adopter.phone_number);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
