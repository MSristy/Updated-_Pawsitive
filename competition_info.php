<?php
// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Initialize competition variable
$competition = null;

// Fetch the competition details based on the ID passed via GET
if (isset($_GET['id'])) {
    $competitionId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM competitions WHERE id = :id");
    $stmt->execute(['id' => $competitionId]);
    $competition = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$competition) {
        echo "<p style='color:red; text-align:center;'>Competition not found!</p>";
        exit;
    }
} else {
    echo "<p style='color:red; text-align:center;'>No competition selected!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $competition ? htmlspecialchars($competition['title']) : 'Competition Details'; ?></title>
    <link rel="stylesheet" href="vet.css"> <!-- Assuming this contains general styles for header/footer -->
    <link rel="stylesheet" href="competition_info.css">
    <style>
        /* Global button styles for the whole website */
      
       header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background: linear-gradient(135deg,rgb(171, 219, 231),rgb(228, 205, 161));
        
        color: black;
        }
        
        footer {
            background:linear-gradient(135deg,rgb(105, 108, 109),rgb(104, 104, 110));
            color: black;
            text-align: center;
            padding: 20px;
            height: 60px;
       }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .competition-details {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }

        h2 {
            margin-top: 30px;
            font-size: 1.5rem;
        }

        .detail-section {
            margin-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
        }

        .detail-section:last-child {
            border-bottom: none;
        }

        .competition-card {
            background-color: #eef7ff;
            border: 1px solid #cce5ff;
            border-radius: 12px;
            padding: 15px;
            margin: 15px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .competition-card strong {
            display: block;
            margin-bottom: 8px;
            font-size: 1.2rem;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?> <!-- Ensure header.php is not overridden here -->

    <div class="competition-details">
        <?php if ($competition): ?>
            <h1><?= htmlspecialchars($competition['title']); ?></h1>

            <div class="detail-section">
                <p><strong>Date:</strong> <?= htmlspecialchars($competition['date']); ?></p>
                <p><strong>Location:</strong> <?= htmlspecialchars($competition['location']); ?></p>
                <p><strong>Contact:</strong> <?= htmlspecialchars($competition['contact']); ?></p>
            </div>

            <div class="detail-section">
                <h2>How to Win</h2>
                <div class="competition-card">
                    <p><?= htmlspecialchars($competition['how_to_win']); ?></p>
                </div>
            </div>

            <div class="detail-section">
                <h2>Previous Winners</h2>
                <div class="competition-card">
                    <p><?= htmlspecialchars($competition['previous_winners']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p style="color:red; text-align:center;">Competition details not available.</p>
        <?php endif; ?>

        <a href="vatenary.php">Back to Competitions</a>
    </div>

    <?php include('templates/footer.php'); ?> <!-- Ensure footer.php is not overridden here -->
    <script src="index.js"></script>
</body>
</html>

