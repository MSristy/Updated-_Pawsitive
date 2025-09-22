<?php
session_start(); // Ensure the session is started

// Initialize variables
$error = '';
$success = '';
$rewards = 0;

// Database connection
$host = 'localhost';
$db = 'paw';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session email is set
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to login page if not authenticated
    header('Location: login.php');
    exit();
}

// Fetch user data based on session email
$user_email = $_SESSION['email'];
$stmt = $conn->prepare('SELECT id, name, email, profile_pic, role, rewards FROM users WHERE email = ?');
$stmt->bind_param('s', $user_email);
$stmt->execute();
$stmt->bind_result($user_id, $name, $email, $profile_pic, $role, $rewards);
if (!$stmt->fetch()) {
    // Handle case where no user is found
    $stmt->close();
    $conn->close();
    die("User not found. Please log in again.");
}
$stmt->close();

// Handle profile updates (name, email, profile picture, password)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $profile_picture = $profile_pic; // Default to current profile picture

    // Handle file upload for profile picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_name = 'images/' . uniqid() . '_' . $_FILES['profile_pic']['name'];
        move_uploaded_file($file_tmp, $file_name);
        $profile_picture = $file_name;
    }

    // Validate and update password if provided
    if (!empty($new_password) && $new_password === $confirm_password) {
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare('UPDATE users SET name = ?, email = ?, profile_pic = ?, password = ? WHERE id = ?');
        $stmt->bind_param('ssssi', $new_name, $new_email, $profile_picture, $password_hash, $user_id);
    } elseif (empty($new_password)) {
        // Update profile without changing the password
        $stmt = $conn->prepare('UPDATE users SET name = ?, email = ?, profile_pic = ? WHERE id = ?');
        $stmt->bind_param('sssi', $new_name, $new_email, $profile_picture, $user_id);
    } else {
        $error = "Passwords do not match.";
    }

    if (empty($error) && isset($stmt) && $stmt->execute()) {
        $success = 'Profile updated successfully!';
        $_SESSION['email'] = $new_email; // Update session email
    } else {
        $error = 'Error updating profile: ' . ($stmt->error ?? 'Unknown error');
    }
    // $stmt->close();
}

// Handle adding new pet
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_pet'])) {
//     $pet_type = $_POST['pet_type'];
//     $pet_picture = 'uploads/default_pet.png'; // Default pet image

//     // Handle file upload for pet picture
//     if (isset($_FILES['pet_picture']) && $_FILES['pet_picture']['error'] === UPLOAD_ERR_OK) {
//         $file_tmp = $_FILES['pet_picture']['tmp_name'];
//         $file_name = 'uploads/' . uniqid() . '_' . $_FILES['pet_picture']['name'];
//         move_uploaded_file($file_tmp, $file_name);
//         $pet_picture = $file_name;
//     }

//     // Insert pet into the database
//     $stmt = $conn->prepare('INSERT INTO user_pets (user_id, pet_type, pet_picture) VALUES (?, ?, ?)');
//     $stmt->bind_param('iss', $user_id, $pet_type, $pet_picture);
    
//     if ($stmt->execute()) {
//         $success = "Pet added successfully!";
//         $rewards += 10; // Reward user for adding a pet
//         $update_rewards = $conn->prepare('UPDATE users SET rewards = ? WHERE id = ?');
//         $update_rewards->bind_param('ii', $rewards, $user_id);
//         $update_rewards->execute();
//         $update_rewards->close();
//     } else {
//         $error = "Error adding pet: " . $stmt->error;
//     }
//     $stmt->close();
// }

// // Fetch user's pets
// $pets = [];
// $stmt = $conn->prepare('SELECT pet_type, pet_picture FROM user_pets WHERE user_id = ?');
// $stmt->bind_param('i', $user_id);
// $stmt->execute();
// $stmt->bind_result($pet_type, $pet_picture);
// while ($stmt->fetch()) {
//     $pets[] = ['type' => $pet_type, 'picture' => $pet_picture];
// }


// Assume this function is triggered when a new blog post is added
function addBlogPost($title, $content, $authorId) {
    global $db; // Use your database connection object

    // Insert the new blog post into the blog_posts table
    $stmt = $db->prepare("INSERT INTO blog_posts (title, content, author_id, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ssi", $title, $content, $authorId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Successfully added the blog post, now update the reward for the user
        updateReward($authorId);
    }

    $stmt->close();
}

// Function to update the user's reward points
function updateReward($userId) {
    global $db; // Use your database connection object

    // Increase the user's reward points by a specific value (e.g., 10 points)
    $rewardPoints = 10;
    $stmt = $db->prepare("UPDATE users SET reward_points = reward_points + ? WHERE id = ?");
    $stmt->bind_param("ii", $rewardPoints, $userId);
    $stmt->execute();
    $stmt->close();
}

// $stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
          background: #e4edec;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ebf0ec;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

      .profile-section {
      display: flex;
      align-items: center;
      gap: 20px; /* Space between the picture and details */
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      border: 1px solid #ddd;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 20px auto;
  }

  .profile-pic img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 2px solid #ddd;
      object-fit: cover;
  }

  .profile-details {
      text-align: right; /* Align the content to the right */
      flex-grow: 1; /* Ensures the details take up remaining space */
  }

  .profile-details p {
      margin: 5px 0;
      font-size: 1rem;
      color: #555;
  }

  .profile-details strong {
      color: #333;
  }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #219653;
        }

        .pets-container {
            display: flex;
            flex-wrap: wrap;
            position: relative;
            gap: 15px;
            left: 10%;
        }

        .pet-card {
            background: #ecf0f1;
            border-radius: 10px;
            padding: 10px;
            width: calc(33.333% - 10px);
            text-align: center;
        }

        .pet-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .rewards {
            background: #d5f5e3;
            padding: 10px;
            border: 1px solid #82e0aa;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .error-msg {
            color: red;
        }

        .success-msg {
            color: green;
        }

 .add-pet {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .add-pet h3 {
      margin-bottom: 20px;
      font-size: 1.5rem;
      text-align: center;
      color: #333;
  }

  .form-group {
      margin-bottom: 15px;
  }

  .form-group label {
      display: block;
      font-size: 1rem;
      color: #555;
      margin-bottom: 5px;
  }

  .form-group input[type="text"],
  .form-group input[type="file"] {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
  }

  button[type="submit"] {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
  }

  button[type="submit"]:hover {
      background-color: #45a049;
  }

  .main-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    max-width: 1000px;
    margin: 30px auto;
    padding: 20px;
}

.profile-section {
    width: 60%; /* Adjust width to take up more space */
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.greeting-section {
    width: 35%; /* Adjust width for the greeting */
    background-color: #ebf5fb;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.greeting-section h2 {
    font-size: 1.8rem;
    color: #2c3e50;
}

.greeting-section p {
    font-size: 1rem;
    color: #34495e;
    margin: 10px 0;
}

.profile-pic img {
    margin-left: 10px;
}

    </style>
</head>
<body>
     <?php include('templates/header.php'); ?>
<div class="container">
    <h2>User Profile</h2>

    <?php if ($error): ?>
        <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success-msg"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

   <div class="main-container">
    <div class="profile-section">
        <div class="profile-pic">
            <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture">
        </div>
        <div class="profile-details">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>
            <p><strong>Rewards:</strong> <?php echo $rewards; ?></p>
        </div>
    </div>
    <div class="greeting-section">
        <h2>Welcome back, <?php echo htmlspecialchars($name); ?>!</h2>
        <p>We’re thrilled to have you here.</p>
        <p>Check out your pets below or add a new one to earn more rewards!!</p>
    </div>
</div>

    <form action="user_profile.php" method="POST" enctype="multipart/form-data">
        <h3>Update Profile</h3>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" style="color: #333;" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="profile_pic">Profile Picture:</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="images/*">
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" style="color: #333;">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" style="color: #333;">
        </div>
        <button type="submit" name="update_profile">Update Profile</button>
    </form>
 </div>
          <!--                  <div class="add-pet">
                                <h3>Add a New Pet</h3>
                                <form action="user_profile.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="pet_type">Pet Type:</label>
                                        <input type="text" id="pet_type" name="pet_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pet_picture">Pet Picture:</label>
                                        <input type="file" id="pet_picture" name="pet_picture" accept="images/*">
                                    </div>
                                    <button type="submit" name="add_pet">Add Pet</button>
                                </form>
                            </div>
                     <div>
                        
                        <div class="pets-container">
                            <h3>Your Pets</h3>
                            <?php foreach ($pets as $pet): ?>
                                <div class="pet-card">
                                    <img src="<?php echo htmlspecialchars($pet['picture']); ?>" alt="Pet Picture">
                                    <p>Type: <?php echo htmlspecialchars($pet['type']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div> 
   -->

</div>

 <?php include('templates/footer.php'); ?>
</body>
</html>
