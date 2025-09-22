<?php
// Database connection
$host = 'localhost';  
$db   = 'paw';    
$user = 'root';       
$pass = '';          

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there is an error, print the error message
    die("Database connection failed: " . $e->getMessage());
}

// Pagination setup
$postsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $postsPerPage;

// Fetch posts from database with pagination
$stmt = $pdo->prepare("SELECT * FROM user_posts ORDER BY date_submitted DESC LIMIT :start, :postsPerPage");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of posts for pagination
$totalPostsStmt = $pdo->query("SELECT COUNT(*) FROM user_posts");
$totalPosts = $totalPostsStmt->fetchColumn();
$totalPages = ceil($totalPosts / $postsPerPage);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption Blog</title>
    <!-- <link rel="stylesheet" href="style_blog.css"> -->
   <style>

                 /* Reset and Basics */
            body, h1, h2, p, ul, li, a {
                margin: 0;
                padding: 0;
                text-decoration: none;
                list-style: none;
                box-sizing: border-box;
            }

            body {
                font-family: cursive;
                background-color: #d4d0c7/* Previous body color retained */
                color: #333;
                line-height: 1.6;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* Header */
            header {
                background-color: #6c63ff;
                padding: 10px 20px;
                color: #fff;
                text-align: center;
                font-size: 1.5em;
            }





            .curved-container {
            position: relative;
            width: 100%;
            max-width: 2000px;
            height: 300px;
            background-color: #5e3b6d; /* Purple background */
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .curved-container::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: 0;
            width: 100%;
            height: 200px;
            background-color: #f3f3f3; /* Background of surrounding area */
            border-radius: 50%;
        }

        .curved-container h1 {
            position: relative;
            font-size: 2.5rem;
            margin: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .curved-container p {
            position: relative;
            font-size: 1.2rem;
            color: #f7725e;
            top: 50%;
            transform: translateY(-50%);
        }

        .paw-print {
            position: absolute;
            top: 50%;
            right: 5%;
            transform: translateY(-50%);
            opacity: 0.8;
            font-size: 10rem;

        }









            /* Main Content */
            .container {
                max-width: 1100px;
                margin: 20px auto;
                padding: 0 20px;
            }

            .content {
                flex: 1;
                margin: 20px auto;
                padding: 20px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Blog Posts */
            .posts {
                display: grid;
                grid-template-columns: repeat(5, 1fr); /* 5 cards per row */
                gap: 15px;
                padding: 10px;
            }

            .post {
                background:rgb(252, 242, 242);
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                overflow: hidden;
              
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .post:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .post img {
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-bottom: 2px solid #f1f1f1;
            }

            .post h2 {
                margin: 15px;
                font-size: 1.2rem;
                color: #333;
                text-align: center;
            }

            .post .meta {
                margin: 0 15px 10px;
                font-size: 0.9rem;
                color: #777;
                text-align: center;
            }

            .post p {
                margin: 0 15px 15px;
                color: #555;
                text-align: justify;
            }

            /* Buttons */
            .btn-apply {
                display: inline-block;
                background-color: #6c63ff;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 1rem;
                text-align: center;
                transition: background-color 0.3s ease;
                text-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
                box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
                margin: 0 auto;
                display: block;
                width: fit-content;
            }

            .btn-apply:hover {
                background-color: #4b47d9;
            }

            /* Pagination */
            .pagination {
                text-align: center;
                margin: 20px 0;
            }

            .pagination a {
                color: #6c63ff;
                margin: 0 5px;
                padding: 5px 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
            }

            .pagination a.active {
                background-color: #6c63ff;
                color: #fff;
            }

            .pagination a:hover {
                background-color: #4b47d9;
                color: #fff;
            }

            /* Sticky Footer */
            footer {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 10px;
                position: relative;
                bottom: 0;
                width: 100%;
                margin-top: auto;
            }

            /* Enhancements */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 300px;
                background: linear-gradient(to bottom, #6c63ff, #f7f7fc);
                z-index: -1;
            }

            /* Responsive Adjustments */
            @media (max-width: 1200px) {
                .posts {
                    grid-template-columns: repeat(4, 1fr); /* 4 cards per row on smaller screens */
                }
            }

            @media (max-width: 992px) {
                .posts {
                    grid-template-columns: repeat(3, 1fr); /* 3 cards per row on tablets */
                }
            }

            @media (max-width: 768px) {
                .posts {
                    grid-template-columns: repeat(2, 1fr); /* 2 cards per row on smaller devices */
                }
            }

            @media (max-width: 576px) {
                .posts {
                    grid-template-columns: 1fr; /* 1 card per row on very small devices */
                }
            }




    </style>

</head>
<body>
    <?php include('templates/header.php'); ?>

    <div class="curved-container">
        <h1>Paws for Thought</h1>
        <p>The Pet Adoption Website Blog</p>
        <div class="paw-print">🐾</div>
    </div>
    
    <div class="container">
        <a href="create_post.php" class="btn-apply">Blog Your Post</a>
    </div>
    
       <div class="content">
        <!-- Blog posts section -->
        <div class="posts">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <img src="<?= $post['picture']; ?>" alt="<?= $post['name']; ?>">
                    <h2><?= $post['name']; ?></h2>
                    <p class="meta">Posted on <?= $post['date_submitted']; ?></p>
                    <p><?= mb_strimwidth($post['blog_post'], 0, 80, "..."); ?></p> <!-- Short description -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    
        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="<?= $i === $page ? 'active' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
</body>
</html>


