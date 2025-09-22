<?php
// Database connection
$host = 'localhost'; 
$db = 'paw';
$user = 'root'; 
$pass = ''; 

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Fetch breed filter from URL if available
$breedFilter = isset($_GET['breed']) ? $_GET['breed'] : null;

// SQL query to fetch pets
if ($breedFilter) {
    $query = "SELECT * FROM pets1 WHERE breed = :breed";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':breed', $breedFilter, PDO::PARAM_STR);
} else {
    $query = "SELECT * FROM pets1"; // Fetch all pets if no filter
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_findPet.css"> 
    <title>Find a Pet</title>
</head>

<body>
<?php include('templates/header.php'); ?>

<div class="find-pet-container">
    <h1>Buy Breeded Pets from here</h1>
    <p>Connecting Pets with Loving Homes.</p>
    
    <div class="pet-buttons">
        <!-- <a href="rehomers.php" class="btn">I need to rehome my pet</a> -->
        <!-- <a href="query.php" class="btn">I have some queries</a> -->
    </div>

    <?php if ($breedFilter): ?>
        <h2>Showing results for breed: <?= htmlspecialchars($breedFilter); ?></h2>
    <?php endif; ?>

    <div class="pet-list">
        <?php foreach ($pets as $pet): ?>
            <div class="pet-card">
                <img src="<?= $pet['image_url']; ?>" alt="<?= htmlspecialchars($pet['name']); ?>">
                <h2>HI! My name is</h2>
                <h3><?= htmlspecialchars($pet['name']); ?></h3>          
                <p><strong>Breed:</strong> <?= htmlspecialchars($pet['breed']); ?></p>
                <a href="knowMore.php?id=<?= $pet['id']; ?>" class="btn">Know More --></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>

<script src="index.js"></script>

</body>
</html>
