<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$host = 'localhost';
$db   = 'paw';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all posts that are approved
$stmt = $pdo->prepare("SELECT * FROM user_posts WHERE approved = 1 ORDER BY date_submitted DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blog - Pet Adoption Blog</title>
    <link rel="stylesheet" href="style_blog.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        .topbar {
             background-color: #003366; /* Deep Blue */
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .topbar a:hover {
            text-decoration: underline;
        }

        .sidebar {
            width: 250px;
            background-color: #2d3a47;
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .container {
            margin-left: 270px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #003366; 
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-apply {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-apply:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="logo">Pawsitive Admin Panel</div>
        <div class="nav-links">
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>

    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="admin_home.php">Admin Home</a>
        <a href="admin_blog.php">Manage Blogs</a>
        <a href="admin_users.php">Manage Users</a>
        <a href="admin_posts.php">User Posts</a>
        <a href="admin_logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>User Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Blog Post</th>
                    <th>Submitted By</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><img src="<?= $post['picture']; ?>" alt="User Post" style="max-width: 100px; border-radius: 5px;"></td>
                        <td><?= htmlspecialchars($post['blog_post']); ?></td>
                        <td><?= htmlspecialchars($post['name']); ?></td>
                        <td><?= $post['date_submitted']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
