<?php 

    include('db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSITIVE - Pet Adoption Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
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
       .footer-links {
        color: black;
        text-decoration: none;
        margin: 0 10px;
        }


         .hero {
            position: relative;
            height: 600px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .hero-slides {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

      .hero-content {
    position: relative;
    z-index: 4;
    text-align: center;
    color: white;
}

.hero-content h1 {
    font-family: Sans-serif;
    font-weight: bold;
    font-size: 10rem; /* Adjust as needed */
    color: white; /* Base color */
    text-shadow: 2px 2px 4px rgba(119, 228, 36, 0.6); /* Shadow for emphasis */
    margin-bottom: 15px;
}

.hero-content p {
    font-family: Arial, sans-serif;
    font-size: 2.5rem; /* Slightly smaller than h1 */
    font-weight: bold;
    color: white; /* Text color */
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Subtle shadow for better visibility */
    margin-top: 10px;
}

        .hero-slide .caption {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.5em;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            color: #ff0;
            border-radius: 10px;
        }

        /* Section Styling */
        .info-section {
            text-align: center;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .info-section h2 {
            font-family: cursive;
            font-size: 2.5em;
            color: red;
            margin-bottom: 20px;
            animation: fade-in 1s ease-in-out;
        }

        /* Cards Container */
        .info-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Card Styling */
        .card {
            background: #f2eeed;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            width: 280px;
            text-align: center;
            animation: slide-up 0.8s ease-in-out;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Icon Styling */
        .icon {
            font-size: 3em;
            margin-bottom: 15px;
            animation: bounce 1.5s infinite;
        }

        /* Button Styling */
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: transparent;
            border: 2px solid #6c63ff;
            color: #6c63ff;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        button:hover {
            background: #6c63ff;
            color: #fff;
        }

        /* Animations */
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

  /* Parent container styling */
.adoption-cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #002855; /* Deep blue background */
    color: #fff;
    padding: 60px;
    border-radius: 10px;
    position: relative;
    overflow: hidden;
}

/* Decorative left bar */
.left-design {
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 100%;
    background: linear-gradient(180deg, #ff5e57, #feca57);
    border-radius: 0 10px 10px 0;
}

/* Text container */
.cta-text {
    flex: 1;
    max-width: 50%;
    padding-right: 20px;
    font-family: 'Roboto', sans-serif; /* Modern, clean font */
}

/* Headline styling */
.cta-text h1 {
    font-size: 4rem; /* Larger, bold text */
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif; /* Eye-catching font for headlines */
}

/* Paragraph styling */
.cta-text p {
    font-size: 1.5rem; /* Larger text for readability */
    line-height: 2;
    margin-bottom: 30px;
    font-family: 'Roboto', sans-serif;
}

/* Call-to-action button */
.cta-button {
    display: inline-block;
    padding: 15px 35px;
    background-color: #ff5e57; /* Bright red button */
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 25px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-family: 'Poppins', sans-serif;
}



/* Image container */
.cta-image {
    flex: 1;
    max-width: 50%;
}

.cta-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

/* Responsive design adjustments */
@media (max-width: 768px) {
    .adoption-cta {
        flex-direction: column;
        padding: 30px;
    }

    .cta-text {
        max-width: 100%;
        padding-right: 0;
        margin-bottom: 20px;
    }

    .cta-text h1 {
        font-size: 3rem;
    }

    .cta-text p {
        font-size: 1.3rem;
    }

    .cta-image {
        max-width: 100%;
    }
}

/* Features Section Styling */
.features-section {
    text-align: center;
    padding: 50px;
    background-color:rgb(250, 219, 219);
    font-family: 'Roboto', sans-serif;
}

.features-section h2 {
    font-size: 2.8rem;
    color: #333;
    margin-bottom: 15px;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
}

.features-section p {
    font-size: 1.3rem;
    color: black;
    margin-bottom: 40px;
}

/* Features Container Styling */
.features-container {
    font-family:cursive;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

/* Individual Card Styling */
.feature-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    padding: 20px;
    flex: 1;
    max-width: 30%;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

/* Icon Styling */
.feature-card .icon {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #48b1f3; /* Blue icon color */
}

/* Animated Bounce for Icons */
.animated-bounce {
    animation: bounce 2s infinite;
}

/* Keyframe Animation for Bounce */
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-15px);
    }
    60% {
        transform: translateY(-8px);
    }
}

/* Card Heading */
.feature-card h3 {
    font-size: 1.6rem;
    color: #333;
    margin-bottom: 10px;
    font-weight: bold;
}

/* Card Text */
.feature-card p {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .features-container {
        flex-direction: column;
        gap: 30px;
    }
    .feature-card {
        max-width: 100%;
    }
}


section.brands {
    padding: 40px 0;
    background-color: #f9f9f9;
    text-align: center;
}

section.brands h1 {
    font-family:cursive;
    font-size: 24px;
    margin-bottom: 30px;
    color: red;
    font-weight: bold;
}

.brands-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    justify-content: center;
    align-items: stretch;
}

.brand {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.brand:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.image-container {
    width: 100%;
    height: 200px;
    overflow: hidden;
    position: relative;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.content {
    padding: 20px;
}

.content h3 {
    font-size: 20px;
    margin: 10px 0;
    color: #333;
    font-weight: bold;
}

.content p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.content a {
    text-decoration: none;
    color: #6a1b9a;
    font-weight: bold;
    transition: color 0.3s;
}

.content a:hover {
    color: #9c27b0;
}



</style>
   

</head>
<body>

   <?php include('templates/header.php'); ?>
    

    <main>
    <section class="hero">
        <div class="hero-slides">
            <div class="hero-slide active" style="background-image: url('home.jpg');">
                <div class="caption">Bring love home—adopt a furry friend</div>
            </div>
            <div class="hero-slide" style="background-image: url('images/Happy Pet.jpg');">
                <div class="caption">Save a life, gain a best friend</div>
            </div>
            <div class="hero-slide" style="background-image: url('images/Happy Pet 2.jpg');">
                <div class="caption">Love is a four-legged word—find your soulmate</div>
            </div>
            <div class="hero-slide" style="background-image: url('images/Happy Pet 3.jpg');">
                <div class="caption">Your perfect companion is waiting—adopt today!</div>
            </div>
            <div class="hero-slide" style="background-image: url('images/images.jpg');">
                <div class="caption">A home without a pet is just a house—adopt and complete your family </div>
            </div>
        </div>
            <div class="hero-content">
                <h1>Be the Reason a Tail Wags Today..!!!</h1>
                <p>Every pet deserves a Loving Home. Could it be yours?</p>
            </div>

    </section>

    <script>
        // Slideshow Animation
        let currentIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');

        setInterval(() => {
            slides[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].classList.add('active');
        }, 4000);
    </script>

    <div class="info-section">
        <h2>Planning to Adopt a Pet?</h2>
        <div class="info-cards">
            <div class="card">
                <div class="icon">🏠</div>
                <h3>Checklist for New Adopters</h3>
                <p>Make the adoption transition as smooth as possible.</p>
                <a href="rehomers.php"><button>Learn More</button></a>
            </div>
            <div class="card">
                <div class="icon">🐾</div>
                <h3>How Old is Your Pet in Human Years?</h3>
                <p>Discover how to calculate the age of any pet in human years—whether it's a dog, cat, or other furry friend.</p>
                <a href="guidelines.php"><button>Learn More</button></a>
            </div>

            <div class="card">
                <div class="icon">❓</div>
                <h3>Pet Adoption FAQs</h3>
                <p>Get answers to all the questions you might have.</p>
                <a href="faq.php"><button>Learn More</button></a>
            </div>
        </div>
    </div>

    <div class="adoption-cta">
    <div class="cta-text">
  
        <h1>"Your generosity gives a voice to the voiceless and a home to those in need."</h1>
        <p>
            Every adoption makes a difference. Be the reason a loving pet finds a forever home. 
            Join us today to create unforgettable bonds and change lives for the better.
        </p>
        <a href="ways_to_help.php" class="cta-button">Donate Now →</a>

    </div>
    <div class="cta-image">
        <img src="images/hh.jpg" alt="Man holding a dog">
    </div>
    </div>


    <section class="brands">
    <div class="container">
        <h1>Types Of Breeds Are Available at PAWSITIVE</h1>
        <div class="brands-grid">
            <!-- Poodle -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/dogpod.png" alt="Poodle">
                </div>
                <div class="content">
                    <h3>Poodle</h3>
                    <p>Learn more about caring for your Poodle.</p>
                    <a href="find-a-pet.php?breed=Poodle">Read More</a>
                </div>
            </div>
            <!-- Exotic Shorthair -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/catExo.png" alt="Exotic Shorthair">
                </div>
                <div class="content">
                    <h3>Exotic Shorthair</h3>
                    <p>Helpful insights on what to expect.</p>
                    <a href="find-a-pet.php?breed=Exotic+Shorthair">Read More</a>
                </div>
            </div>
            <!-- Budgerigar -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/nooo.png" alt="Budgerigar">
                </div>
                <div class="content">
                    <h3>Budgerigar</h3>
                    <p>Learn how to care for your Budgerigar.</p>
                    <a href="find-a-pet.php?breed=Budgerigar">Read More</a>
                </div>
            </div>
            <!-- Bichon Frisé -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/dog2.png" alt="Bichon Frisé">
                </div>
                <div class="content">
                    <h3>Bichon Frisé</h3>
                    <p>Discover tips on raising a Bichon Frisé.</p>
                    <a href="find-a-pet.php?breed=Bichon+Frisé">Read More</a>
                </div>
            </div>
            <!-- Norwegian Forest Cat -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/catNor.png" alt="Norwegian Forest Cat">
                </div>
                <div class="content">
                    <h3>Norwegian Forest Cat</h3>
                    <p>Get advice on caring for this unique breed.</p>
                    <a href="find-a-pet.php?breed=Norwegian+Forest+Cat">Read More</a>
                </div>
            </div>
            <!-- Cockatiel -->
            <div class="brand">
                <div class="image-container">
                    <img src="images/imagas.png" alt="Cockatiel">
                </div>
                <div class="content">
                    <h3>Cockatiel</h3>
                    <p>Learn about Cockatiel care and training.</p>
                    <a href="find-a-pet.php?breed=Cockatiel">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>



        <div class="features-section">
            <h2>Why Choose Pawsitive?</h2>
            <p>Because we believe every pet deserves a loving home and a safe journey to their new family.</p>
            <div class="features-container">
                <div class="feature-card">
                    <div class="icon animated-bounce">❤️</div>
                    <h3>Compassionate Care</h3>
                    <p>
                        We prioritize the well-being of every pet, ensuring they are placed in homes 
                        where they will be cherished and cared for.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="icon animated-bounce">🐾</div>
                    <h3>Advocacy for Adoption</h3>
                    <p>
                        Supporting adoption over buying, we aim to reduce unethical breeding and 
                        ensure every pet finds a forever home.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="icon animated-bounce">🏆</div>
                    <h3>Ethical Rehoming</h3>
                    <p>
                        Our processes focus on safety and compatibility, ensuring the perfect match 
                        between adopters and pets.
                    </p>
                </div>
            </div>
        </div>



        <section class="testimonials">
            <div class="container">
                <h2>Happy Adoption Stories</h2>
                <div class="testimonials-grid">
                    <div class="testimonial">
                        <img src="images/stry.png" alt="Happy Pet Owner">
                        <p>"Adopting from PAWSITIVE was the best decision ever!" - Helena</p>
                    </div>
                    <div class="testimonial">
                        <img src="images/m.jpg" alt="Happy Pet Owner">
                        <p>"Thank you PAWSITIVE for helping us find our furry friend." - Lisa</p>
                    </div>
                    <div class="testimonial">
                        <img src="images/birdstory.png" alt="Happy Pet Owner">
                        <p>"Our new puppy is the perfect addition to our family." - Maryam</p>
                    </div>
                </div>
            </div>
            <div>
                <a href="blog.php"><p><h2>Add Your Stories</h2></p></a>
            </div>
        </section>
    

    </main>

    <section class="cta">
        <div class="container">
            <h3>Join Our Community</h3>
            <p>Share your adoption stories and connect with other pet lovers.</p>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>
    <script src="index.js"></script>
</body>
</html>
 