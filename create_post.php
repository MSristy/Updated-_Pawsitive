<?php
// Include database connection file
include('db_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
    // Sanitize and validate the inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $blog_post = htmlspecialchars(trim($_POST['blog_post']));
    $picture = ''; // Initialize picture variable

    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        // Define the upload directory
        $upload_dir = 'images/'; // You can change this path as needed
        $file_name = $_FILES['picture']['name'];
        $file_tmp_name = $_FILES['picture']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext;
        $file_path = $upload_dir . $new_file_name;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            $picture = $file_path; // Set the picture path to be saved in the database
        } else {
            $error_message = "Failed to upload the picture.";
        }
    }

    // Insert the post data into the database
    if (empty($error_message)) {
        $sql = "INSERT INTO user_posts (name, email, blog_post, picture, date_submitted, approved, is_approved) 
                VALUES (?, ?, ?, ?, NOW(), 1, 1)"; // Directly approved and is_approved as 1
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $blog_post, $picture);

        if ($stmt->execute()) {
            // Success, redirect to the blog page where the new post will be fetched
            $success_message = "Your post has been successfully submitted!";
            header("Location: blog.php?post_success=true"); // Redirect to blog.php with a success flag
            exit();
        } else {
            $error_message = "Failed to submit your post. Please try again.";
        }

        $stmt->close();
    }
}

// Include header
include('templates/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Your Post - Pet Adoption Blog</title>
    <style>
        /* Add your styles here */
         /* Reset and Basics */
        body {
            font-family: Arial, sans-serif;
            background: #e4ede4/* Soft gradient background */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 70vh;
        }

        /* Container styling with red border */
        .container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Slightly deeper shadow */
            border-radius: 12px; /* Slightly more rounded corners */
            overflow: hidden;
            border: 3px solid red; /* Red border for the entire form container */
        }

        .content {
            padding: 40px;
        }

        /* Form Field Updates */
        input[type="text"],
        input[type="email"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #dfe4ea; /* Softer border color */
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #f9fafb; /* Light background for form fields */
        }

        /* Focus effect for input fields and textarea */
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border: 1px solid red; /* Red border on focus */
            outline: none;
            background-color: #fff; /* Light background on focus */
        }

        /* Submit Button */
        .btn-apply {
            background-color: #6c63ff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px; /* Match input fields */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-apply:hover {
            background-color: #4b47d9;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Footer Styling */
        footer {
            margin-top: auto;
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 20px 0;
        }

        /* Success Message Styling */
        .success-messages {
            margin-bottom: 20px;
            text-align: center;
        }

        .success-message {
            background-color: #4caf50; /* Green background */
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 1.2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .success-message h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .success-message p {
            margin-top: 10px;
        }

        .success-message:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <form action="create_post.php" method="POST" enctype="multipart/form-data">
                <h2>Blog Your Post</h2>

                <!-- Display Success Message -->
                <?php if (!empty($success_message)): ?>
                    <div class="success-messages">
                        <div class="success-message">
                            <h3>Success!</h3>
                            <p><?= htmlspecialchars($success_message); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Display Error Message -->
                <?php if (!empty($error_message)): ?>
                    <div class="error-messages">
                        <p><?= htmlspecialchars($error_message); ?></p>
                    </div>
                <?php endif; ?>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>

                <label for="blog_post">Blog Post:</label>
                <textarea id="blog_post" name="blog_post" rows="10" required><?= isset($_POST['blog_post']) ? htmlspecialchars($_POST['blog_post']) : ''; ?></textarea>

                <label for="picture">Upload a Picture:</label>
                <input type="file" id="picture" name="picture" accept="image/*">

                <button type="submit" name="submit_post">Submit Post</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Include footer
include('templates/footer.php');
?>


