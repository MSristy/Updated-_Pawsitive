<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'paw');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch pet data
$sql = "SELECT * FROM localpets";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            font-family: "Raleway", sans-serif;
            margin: 20px 0;
        }

        /* Slideshow styles */
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 650px;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
        }

        .slides {
            display: none;
            width: 100%;
            animation: fade 1.5s ease-in-out;
        }

        @keyframes fade {
            from { opacity: 0.4; }
            to { opacity: 1; }
        }

        .slideshow-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-family: cursive;
            padding: 20px;
            border-radius: 10px;
            font-size: 1.5em;
            font-weight: bold;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Pet card styles */
        .pet-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 60px;
            padding: 40px;
        }

        .pet-card {
            background: linear-gradient(135deg,rgb(250, 237, 237),rgb(244, 236, 222));
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 525px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pet-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .pet-card img.main-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .pet-card img.avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-top: -40px;
            border: 4px solid #fff;
            object-fit: cover;
        }

        .pet-card .info {
            padding: 15px;
        }

        .pet-card .info h2 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .pet-card .info p {
            margin: 5px 0;
            color: #666;
        }

        .pet-card .info .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #6c63ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pet-card .info .btn:hover {
            background-color: #5246c7;
        }
        
        /* About Section */
        .about-section {
            background: linear-gradient(to bottom,rgb(250, 255, 252),rgb(219, 228, 172));
            padding:40px;
            border-radius: 20px;
            width: 950px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .about-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .about-image {
            width: 300px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .about-text {
            
            max-width: 600px;
            text-align: left;
        }

        .about-text h2 {
            font-size: 2.5em;
            color:rgb(126, 123, 75);
            margin-bottom: 10px;
        }

        .about-text p {
            font-size: 1.2em;
            color: #555;
        }

        /* Testimonials Section */
        .testimonials-section {
            background: linear-gradient(to bottom,rgb(250, 255, 252),rgb(198, 214, 250));
            padding:40px;
            border-radius: 20px;
            width: 950px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .testimonial-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .testimonial-image {
            width: 300px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .testimonial-text {
            max-width: 600px;
            text-align: left;
        }

        .testimonial-text h2 {
            font-size: 2.5em;
            color:rgb(87, 76, 240);;
            margin-bottom: 10px;
        }

        .testimonial-text p {
            font-size: 1.2em;
            color: #555;
        }

        /* Get Involved Section */
        .get-involved-section {
            background: linear-gradient(to bottom,rgb(248, 255, 251),rgb(217, 248, 217));
            padding:40px;
            border-radius: 20px;
            width: 950px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .get-involved-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .get-involved-image {
            width: 300px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .get-involved-text {
            max-width: 600px;
            text-align: left;
        }

        .get-involved-text h2 {
            font-size: 2.5em;
            color:rgb(182, 243, 85);
            margin-bottom: 10px;
        }

        .get-involved-text p {
            font-size: 1.2em;
            color: #555;
        }

        .get-involved-text .btn {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .get-involved-text .btn:hover {
            background-color: #0056b3;
        }



        .tips-section {
        display: flex;
        justify-content: space-between;
        background-color: #f7f7f7;
        padding: 20px;
        margin: 30px 0;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tip {
        flex: 1;
        margin: 0 10px;
        padding: 15px;
        text-align: left;
        background: linear-gradient(135deg,rgb(253, 230, 230),rgb(253, 235, 205));
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tip h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .tip ul {
        font-family: cursive;
        font-size: 1em;
        color: #555;
        line-height: 1.6;
        padding-left: 20px;
        }

        .tip ul li {
        margin-bottom: 10px;
        }




         .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #66918e;
            color: black;
            font-family: cursive;
            width: 100%;
            padding: 96px;
        }

        .text-content {
            max-width: 50%;
        }

        .text-content h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .text-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .text-content .cta-button {
            display: inline-block;
            background-color: #ff6600;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .text-content .cta-button:hover {
            background-color: #e65500;
        }

        .image-content {
            flex: 1;
            padding-left: 20px;
            width: 100%;
        }

        .image-content img {
            max-width: 100%;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
            }

            .text-content {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .image-content {
                padding-left: 0;
            }
        }



    </style>
</head>
<body>

    <?php include('templates/header.php'); ?>

    <div class="container">
        <div class="text-content">
            <h1>Our animal sanctuary is at the heart of Best Friends</h1>
            <p>Best Friends Animal Sanctuary is the healing home for up to 300 dogs, cats, birds, and other animals looking for a second chance.</p>
            <a href="guidelines.php" class="cta-button">Follow The Guidelines»</a>
        </div>
        <div class="image-content">
            <img src="images/x.png" alt="Sanctuary Image">
        </div>
    </div>


    <!-- Pet Cards -->
    <div class="pet-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="pet-card">
                    <img class="main-image" src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Pet Image">
                    <img class="avatar" src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Pet Avatar">
                    <div class="info">
                        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p><strong>Type</strong> <?php echo htmlspecialchars($row['breed']); ?></p>
                        <p><strong>Age:</strong> <?php echo htmlspecialchars($row['age']); ?> years</p>
                        <p><strong></strong> <?php echo htmlspecialchars($row['sex']); ?></p>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="adopters.php" class="btn">Adopt Me</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No pets available for adoption.</p>
        <?php endif; ?>
    </div>
    


        <!-- About Section -->
    <div class="about-section">
        <div class="about-content">
            <img src="images/about-us.png" alt="About Us" class="about-image">
            <div class="about-text">
                <h2>About Us</h2>
                <p>We are dedicated to connecting loving families with pets in need. With over 14,500 shelters and rescues in our network, we strive to find every pet a forever home. Our mission is to create a compassionate community where every pet is cared for and loved.</p>
            </div>
        </div>
    </div>

    <!-- Happy Tails Section -->
    <div class="testimonials-section">
        <div class="testimonial-content">
            <img src="images/happy.jpeg" alt="Happy Tails" class="testimonial-image">
            <div class="testimonial-text">
                <h2>Happy Tails</h2>
                <p>"Adopting from this platform was the best decision we ever made! Our new furry friend has brought so much joy to our lives." - Jane D.</p>
            </div>
        </div>
    </div>

    <!-- Get Involved Section -->
    <div class="get-involved-section">
        <div class="get-involved-content">
            <img src="images/get.png" alt="Get Involved" class="get-involved-image">
            <div class="get-involved-text">
                <h2>Get Involved</h2>
                <p>Join us in our mission to help pets find loving homes. Volunteer, donate, or spread the word to make a difference. Together, we can create a brighter future for every pet in need.</p>
            </div>
        </div>
    </div>


 <div class="tips-section">
    <div class="tip">
        <h3>🐶 Dog Care Tips</h3>
        <ul>
        <li>Provide a balanced diet with high-quality dog food suitable for their age and breed.</li>
        <li>Ensure daily exercise like walks, playtime, or training to keep them physically active.</li>
        <li>Schedule regular vet checkups and keep vaccinations up to date.</li>
        <li>Maintain good hygiene by grooming, bathing, and brushing their coat regularly.</li>
        <li>Offer chew toys to promote dental health and reduce destructive chewing.</li>
        <li>Spend quality time with your dog to build trust and reduce anxiety.</li>
        </ul>
    </div>
    <div class="tip">
        <h3>🐱 Cat Care Tips</h3>
        <ul>
        <li>Provide fresh water and a balanced diet designed for cats.</li>
        <li>Keep the litter box clean and place it in a quiet, accessible location.</li>
        <li>Offer scratching posts to prevent furniture damage and promote healthy claws.</li>
        <li>Play with your cat daily using toys to stimulate their hunting instincts.</li>
        <li>Regularly groom your cat to prevent matting and reduce shedding.</li>
        <li>Schedule routine vet visits to monitor their health and well-being.</li>
        </ul>
    </div>
    <div class="tip">
        <h3>🐦 Bird Care Tips</h3>
        <ul>
        <li>Provide a spacious cage with perches, toys, and enough room to stretch their wings.</li>
        <li>Clean the cage and change the water daily to maintain hygiene.</li>
        <li>Feed a varied diet that includes seeds, pellets, fruits, and vegetables.</li>
        <li>Offer opportunities for flight or out-of-cage time in a safe environment.</li>
        <li>Socialize with your bird daily to prevent boredom and build trust.</li>
        <li>Schedule annual vet checkups to monitor their health and prevent illnesses.</li>
        </ul>
    </div>
 </div>


 <h1> THANKS TO VISIT US.</h1>




    <?php include('templates/footer.php'); ?>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            const slides = document.querySelectorAll(".slides");
            slides.forEach(slide => slide.style.display = "none");
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1; }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        function plusSlides(n) {
            slideIndex += n - 1;
            showSlides();
        }
    </script>

</body>
</html>