<?php
// Include database connection
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

$message = ""; // Initialize message variable

// Check if a total amount is passed from checkout
$donation_amount = isset($_GET['total']) ? $_GET['total'] : '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables with default values
    $donation_amount = isset($_POST['donation_amount']) ? $_POST['donation_amount'] : null;
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $shelter = isset($_POST['shelter']) ? $_POST['shelter'] : null;
    $in_honor_of = isset($_POST['in_honor_of']) ? $_POST['in_honor_of'] : null;
    $additional_message = isset($_POST['additional_message']) ? $_POST['additional_message'] : null;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;

    // Validate required fields
    if ($donation_amount && $category && $payment_method && ($category !== 'shelter' || $shelter)) {
        // Insert data into the database
        try {
            $sql = "INSERT INTO donation (donation_amount, category, shelter, in_honor_of, additional_message, payment_method) 
            VALUES (:donation_amount, :category, :shelter, :in_honor_of, :additional_message, :payment_method)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':donation_amount', $donation_amount);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':shelter', $shelter);
            $stmt->bindParam(':in_honor_of', $in_honor_of);
            $stmt->bindParam(':additional_message', $additional_message);
            $stmt->bindParam(':payment_method', $payment_method);

            $stmt->execute();

            // Set success message based on category
            if ($category === 'marketplace') {
                $message = "Payment Successful";
            } elseif ($category === 'shelter') {
                $message = "Thank you for your Donation!!";
            } else {
                $message = "Transaction Completed Successfully.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Please Fill in all Required Fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="donation.css">
  <title>Donation</title>
  <style>
   /* Global Styles */
body {
  font-family: 'Arial', sans-serif;
  background-color: #f0f2f5;
  margin: 0;
  padding: 0;
  height: 100%; /* Ensure body takes full height */
  display: flex;
  flex-direction: column;
}

h2 {
  font-size: 2rem;
  color: #333;
}

.message-container {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
  padding: 15px 20px;
  border-radius: 5px;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  margin: 20px auto;
  max-width: 500px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Harmonious Section */
.harmonious-div {
  display: flex;
  justify-content: center; /* Center content horizontally */
  align-items: center; /* Center content vertically */
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  margin: 40px auto;
  padding: 30px;
  width: 100%;
  max-height: 800px;
  max-width: 800px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.harmonious-div:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.harmonious-content {
  width: 80%;
  max-width: 400px;
}

.harmonious-image {
  width: 35%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.harmonious-image img {
  max-width: 100%;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%; /* Ensure form group takes full width */
}

.form-group label {
  font-size: 1.1rem;
  color: #333;
  margin-bottom: 8px;
}

.form-group input, .form-group select {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 1rem;
  box-sizing: border-box;
}

.form-group input:focus, .form-group select:focus {
  border-color: #007bff;
  outline: none;
}

.submit-button {
  background-color: #28a745;
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1.1rem;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

.submit-button:hover {
  background-color: #218838;
}

.payment-options {
  display: flex;
  gap: 20px;
  justify-content: flex-start;
  margin-top: 20px;
}

.payment-options label {
  cursor: pointer;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.payment-options input[type="radio"] {
  display: none;
}

.payment-options img {
  width: 80px;
  height: 80px;
  object-fit: contain;
  border-radius: 8px;
  border: 2px solid transparent;
  transition: transform 0.2s ease, border 0.2s ease;
}

.payment-options input[type="radio"]:checked + img {
  transform: scale(1.1);
  border-color: #007bff;
}

.hidden {
  display: none;
}

/* Responsive Design */
@media (max-width: 768px) {
  .harmonious-div {
    flex-direction: column;
    align-items: center;
  }

  .harmonious-content, .harmonious-image {
    width: 100%;
  }

  .submit-button {
    width: 100%;
  }
}

/* Footer Styles */
.footer {
  position: relative;
  bottom: 0;
  width: 100%;
  background-color: #333; /* You can change the background color */
  color: #fff; /* Text color */
  text-align: center;
  padding: 10px 0;
  font-size: 14px;
  margin-top: auto; /* Ensures footer is pushed to the bottom */
}


  </style>

  <script>
    function toggleFields() {
      const category = document.querySelector('input[name="category"]:checked').value;
      const shelterFields = document.getElementById('shelter-fields');
      const additionalFields = document.getElementById('additional-fields');

      if (category === 'shelter') {
        shelterFields.classList.remove('hidden');
        additionalFields.classList.remove('hidden');
      } else {
        shelterFields.classList.add('hidden');
        additionalFields.classList.add('hidden');
      }
    }
  </script>
</head>
<body>

<?php include('templates/header.php'); ?>

<div class="harmonious-div">
    <form action="donation.php" method="post" class="donation-form">
       <div class="form-group">
            <label for="donation-amount">Select or Enter an Amount</label>
            <input type="number" id="donation-amount" name="donation_amount" placeholder="$" min="0.01" step="any" required value="<?= htmlspecialchars($donation_amount) ?>">
       </div>

        <!-- Choose Category -->
        <div class="form-group">
            <label>Choose Category</label>
            <label>
                <input type="radio" name="category" value="shelter" onclick="toggleFields()" required>
                Shelter
            </label>
            <label>
                <input type="radio" name="category" value="marketplace" onclick="toggleFields()">
                Marketplace
            </label>
        </div>

        <!-- Shelter Fields -->
        <div id="shelter-fields" class="hidden">
            <div class="form-group">
                <label for="shelter">Select Shelter</label>
                <select id="shelter" name="shelter">
                    <option value="" disabled selected>Select a Shelter</option>
                    <option value="shelter_1">Shelter 1</option>
                    <option value="shelter_2">Shelter 2</option>
                    <option value="shelter_3">Shelter 3</option>
                </select>
            </div>
        </div>

        <!-- Additional Fields -->
        <div id="additional-fields" class="hidden">
            <div class="form-group">
                <label for="honor">In Honor Of</label>
                <input type="text" id="honor" name="in_honor_of" placeholder="Enter a name">
            </div>
            <div class="form-group">
                <label for="message">Additional message</label>
                <input type="text" id="message" name="additional_message" placeholder="Enter a message">
            </div>
        </div>

        <!-- Payment Options -->
        <div class="form-group">
            <label for="payment-method">Choose payment option</label>
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment_method" value="bkash" required>
                    <img src="images/bkash.png" alt="bKash">
                </label>
                <label>
                    <input type="radio" name="payment_method" value="rocket" required>
                    <img src="images/rocket.png" alt="Rocket">
                </label>
                <label>
                    <input type="radio" name="payment_method" value="nagad" required>
                    <img src="images/nagad.png" alt="Nagad">
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-button">Submit</button>
    </form>

    <!-- Display Message -->
    <?php if ($message): ?>
        <div class="message-container">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

</div>

<!-- <?php include('templates/footer.php'); ?> -->

</body>
</html>
