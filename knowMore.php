<?php
// Database connection
$host = 'localhost'; 
$db = 'paw';
$user = 'root'; 
$pass = ''; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch pet details based on the ID passed in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM pets1 WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        die("Pet not found.");
    }
} else {
    die("Invalid request.");
}

// Fetch suggestions for other pets
$suggestionsQuery = "SELECT * FROM pets1 WHERE id != :id LIMIT 5";
$suggestionsStmt = $conn->prepare($suggestionsQuery);
$suggestionsStmt->bindParam(':id', $id, PDO::PARAM_INT);
$suggestionsStmt->execute();
$suggestedPets = $suggestionsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="knowMore.css"> 
    <title>Know More About <?= htmlspecialchars($pet['name']); ?></title>


<style> 
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.know-more-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
    gap: 20px;
}

.pet-profile {
    flex: 1;
    max-width: 400px;
    text-align: center;
}

.pet-profile img.main-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1s ease-in-out;
}

.additional-images img {
    width: 150px;
    height: 150px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s;
}

.additional-images img:hover {
    transform: scale(1.1);
}

.pet-details {
    text-align: center;
    flex: 2;
    max-width: 600px;
    background: rgb(248, 227, 227);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: slideIn 1s ease-in-out;
}

.pet-details h1 {
    margin-bottom: 10px;
    color: #070707;
}

.pet-details p {
    margin: 5px 0;
    line-height: 1.5;
}

.pet-details h2 {
    margin-top: 20px;
    color: #25301f;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateX(-50px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.adopt-btn {
    display: inline-block;
    background-color: #ff6f61;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

.adopt-btn:hover {
    background-color: #e9b3fa;
}

.extra-info {
    text-align: center;
    margin-top: 10px;
    background-color: #e2e2db;
    padding: 100px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.slideshow-container {
    background: url('images/n.jpg') no-repeat center center/cover;;
    padding: 100px;
    display: center;
    flex-wrap: nowrap;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 10px;
}

.slide {
    flex: 0 0 300px;
    scroll-snap-align: center;
    background-color: #e7eed4;
    padding: 100px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

.slide h2 {
    color: #333;
}

.slide p {
    color: #555;
}

.pet-care-container {
    background: #fff;
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.pet-care-container h1 {
    text-align: center;
    font-family:cursive;
    margin-top: 10px;
    font-size: 20px;
    color: #333;
}

.suggested-pets {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
}

.suggested-pet {
    width: 200px;
    text-align: center;
    background: #e3e9ca;
    padding: 80px;
    margin: 50px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.suggested-pet img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.suggested-pet p {
    margin: 10px 0 5px;
    font-weight: bold;
}

.suggested-pet a {
    display: inline-block;
    background: #868a86;
    color: white;
    padding: 5px 10px;
    text-decoration:dotted;
    border-radius: 5px;
    transition: background-color 3s;
}

.suggested-pet a:hover {
    background: #e9b3fa;
}






.pet-care-container {
    background: #eee2e2;
    padding: 20px;
    margin-top: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.pet-care-container h1 {
    text-align: center;
    font-family: cursive;
    margin-top: 10px;
    font-size: 20px;
    color: #333;
}

.pet-care-container p {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
    text-align: justify;
}

</style>

</head>

<body>
<?php include('templates/header.php'); ?>

<div class="know-more-container">
    <div class="pet-profile">
        <img src="<?= $pet['image_url']; ?>" alt="<?= htmlspecialchars($pet['name']); ?>" class="main-image">
        <div class="additional-images">
            <?php
            $additionalImages = json_decode($pet['additional_images'], true);
            if ($additionalImages) {
                foreach ($additionalImages as $image) {
                    echo "<img src='$image' alt='Additional image of {$pet['name']}' class='additional-image'>";
                }
            }
            ?>
        </div>
    </div>
    
    <div class="pet-details">
    <h1>Meet <?= htmlspecialchars($pet['name']); ?></h1>
    <p><strong>Age:</strong> <?= htmlspecialchars($pet['age']); ?></p>
    <p><strong>Gender:</strong> <?= htmlspecialchars($pet['gender']); ?></p>
    <p><strong>Size:</strong> <?= htmlspecialchars($pet['pet_size']); ?></p>
    <p><strong>Temperament:</strong> <?= htmlspecialchars($pet['temp']); ?></p>
    <p><strong>Breed:</strong> <?= htmlspecialchars($pet['breed']); ?></p>
    <p><strong>Location:</strong> <?= htmlspecialchars($pet['location']); ?></p>
    <p><strong>Adoption Fee:</strong> <?= htmlspecialchars($pet['fee']); ?></p>
    <h1>Story</h1>
    <h2><?= nl2br(htmlspecialchars($pet['story'])); ?></h2>

    <!-- Adopt This Pet Button (updated) -->
    <button type="button" class="btn adopt-btn" onclick="window.location.href='donation.php?pet_id=<?= $pet['id']; ?>'">Purshase</button>
</div>

</div>


<div class="extra-info">
    <h1>Additional Information</h1> 
    <div class="slideshow-container">
        <div class="slide">
            <h3>Suggested Pets</h3>
            <ul>
                <?php foreach ($suggestedPets as $suggestedPet): ?>
                    <li>
                        <a href="knowMore.php?id=<?= $suggestedPet['id']; ?>">
                            <?= htmlspecialchars($suggestedPet['name']); ?> - <?= htmlspecialchars($suggestedPet['breed']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="slide">
            <h1>Food Recommendations</h1>
            <p>Ensure your pet stays healthy with the best food options. Consult a vet for dietary needs specific to <?= htmlspecialchars($pet['breed']); ?>.</p>
        </div>
        <div class="slide">
            <h1>Pet Care Tips</h1>
            <p>Regular grooming, proper nutrition, and routine vet visits are essential for <?= htmlspecialchars($pet['name']); ?>. Create a loving and safe environment!</p>
        </div>
    </div>

    <div class="pet-care-container">
        <h1>Pet Care Advice</h1>
        <p>We provide you with the best tips and tricks to ensure your furry friend's happiness and well-being. Explore our resources for grooming, health, and training!</p>
    </div>
</div>




<div class="pet-care-container">

    <h1>Suggested Pets</h1>
    <div class="suggested-pets">
        <?php
        $suggestedPets = json_decode($pet['suggested_pets'], true);
        if ($suggestedPets) {
            $query = "SELECT id, name, image_url FROM pets1 WHERE id IN (" . implode(',', $suggestedPets) . ")";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $suggested = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($suggested as $suggestedPet) {
                echo "<div class='suggested-pet'>
                        <img src='{$suggestedPet['image_url']}' alt='{$suggestedPet['name']}'>
                        <p>{$suggestedPet['name']}</p>
                        <a href='knowMore.php?id={$suggestedPet['id']}' class='btn'>View Details</a>
                      </div>";
            }
        }
        ?>
    </div>
</div>


<?php include('templates/footer.php'); ?>

<script>
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');

function showSlides() {
    slides.forEach((slide, index) => {
        slide.style.display = index === slideIndex ? 'block' : 'none';
    });
    slideIndex = (slideIndex + 1) % slides.length;
    setTimeout(showSlides, 3000); // Change slide every 3 seconds
}

showSlides();
</script>

</body>
</html>
