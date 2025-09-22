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

// Query for rehomers application
$rehomers_sql = "SELECT * FROM rehomers_application WHERE approved = 1";
$rehomers_result = $conn->query($rehomers_sql);

if (!$rehomers_result) {
    $rehomers_result = null;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehomers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
.hero-container {
    position: relative;
    width: 100%;
    margin-top: 0; /* Ensure no extra margin between header and hero section */
}

.hero-image {
    position: relative;
    width: 100%;
    height: 60vh; /* Adjust the height as needed */
    overflow: hidden;
}

.hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-text-overlay {
    position: absolute;
    top: 50%;
    left: 40%; /* Shift the overlay text slightly to the left */
    transform: translate(-40%, -50%);
    text-align: left; /* Align the text content to the left */
    color: white;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for readability */
    padding: 20px;
    border-radius: 10px;
    max-width: 900px; /* Optional: Limit width for a neat design */
}

.hero-text-overlay h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.hero-text-overlay p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.cta-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ff6600;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}



.cta-button:hover {
    background-color: #e55a00;
}

        .rehomers-body{
             background: #ebf5ee;
        }
        .rehomers-top {
            background: #005477;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

    </style>
</head>
<body class="rehomers-body">
<?php include('templates/header.php'); ?>

 <div class="hero-container">
    <div class="hero-image">
        <img src="images/rehomers pic 5.jpg" alt="Sanctuary Image">
        <div class="hero-text-overlay">
            <h1>Giving Every Animal the Home They Deserve</h1>
            <p>Best Friends Animal Sanctuary is the healing home for up to 300 dogs, cats, birds, bunnies, and other animals looking for a second chance.</p>
            <!-- <a href="guidelines.php" class="cta-button">Follow The Guidelines »</a> -->
        </div>
    </div>
</div>


<!-- Banner Section -->
  <!-- <section class="rehomers-top">
            <h1 class="text-4xl font-bold">Rehomers</h1>
            <p class="mt-4 text-lg">Help match pets with loving homes through our rehoming process.</p>
        </section>
 -->

<!-- Application Section -->
<section class="py-8 px-4 md:px-16">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="text-center mb-6">

            <h2 class="text-2xl font-bold">Start the Application Process</h2>
             <p class="mt-6 text-xl leading-relaxed">
            Join us in helping pets find loving homes through our efficient rehoming process. 
            Your kindness can create lasting bonds and save lives.
        </p>
        </div>
        <div class="flex flex-col md:flex-row justify-center gap-6">
            <a href="rehomers_applications.php" class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg text-lg font-semibold">Rehomers Application</a>
            <a href="temporary_housing.php" class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg text-lg font-semibold">Apply for Temporary Housing</a>
        </div>
    </div>
</section>

<!-- The Rehoming Process Section -->
<section class="py-12" style="background: linear-gradient(135deg, rgb(248, 224, 224), rgb(248, 236, 214));">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-6">The Rehoming Process</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="images/image02.png" alt="Application" class="w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mt-4">Application</h3>
                <p class="text-gray-600">Fill out the application and we will get back to you within 48 hours.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="images/images_03.png" alt="Follow-Up" class="w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mt-4">Follow-Up</h3>
                <p class="text-gray-600">We will follow up with you to discuss your application.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="images/image_5.png" alt="Placement" class="w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mt-4">Placement</h3>
                <p class="text-gray-600">We will match you with an animal in need of rehoming.</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="images/image_6.png" alt="Home Visit" class="w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mt-4">Home Visit</h3>
                <p class="text-gray-600">We'll schedule a home visit to ensure the environment is safe for the pet.</p>
            </div>
        </div>
    </div>
</section>


<!-- Approved Rehomers Applications Section -->
<section class="py-12 px-4 md:px-16">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Available Pets for Rehoming</h2>
        <?php if ($rehomers_result && $rehomers_result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border border-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Pet Choice</th>
                            <th class="px-4 py-2">Pet Age</th>
                            <th class="px-4 py-2">Pet Picture</th>
                            <th class="px-4 py-2">Adoption</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $rehomers_result->fetch_assoc()): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($row['pet_choice']); ?></td>
                                <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($row['pet_age']); ?></td>
                                <td class="px-4 py-2 text-gray-700">
                                    <img src="<?php echo htmlspecialchars($row['pet_picture']); ?>" alt="Pet Picture" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-4 py-2">
                                    <a href="adopters.php?id=<?php echo intval($row['id']); ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">Adopt</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-600">No approved rehomers applications found.</p>
        <?php endif; ?>
    </div>
</section>

<?php include('templates/footer.php'); ?>
</body>
</html>
