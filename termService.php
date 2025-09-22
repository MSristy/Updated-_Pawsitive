<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Service - PAWSITIVE</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%; /* Ensure the page takes full height */
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333333;
            line-height: 1.6;
        }

        main {
            flex: 1; /* Makes the main content take up available space */
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 2em;
            color: #0066cc;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 20px;
            font-size: 1.5em;
            color: #009990;
        }

        p, ul {
            font-size: 1em;
            margin-bottom: 20px;
            line-height: 1.8;
            color: #555555;
        }

        ul {
            list-style-type: square;
            padding-left: 20px;
        }

        a {
            color: #0066cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .highlight {
            color: #009990;
            font-weight: bold;
        }

        footer {
            background-color: #009990; /* Match your desired footer color */
            color: white;
            text-align: center;
            padding: 15px 0;
            position: relative;
            width: 100%;
            bottom: 0;
        }

        footer .footer-links {
            margin-bottom: 10px; /* Space between links and copyright */
        }

        footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer p {
            margin: 0; /* Remove extra space below the text */
            font-size: 14px;
        }
        text-decoration: underline;
                }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <main>
        <h2>Terms and Service</h2>
        <p>Welcome to PAWSITIVE! By accessing or using our services, you agree to the terms outlined below. Please read them carefully.</p>
      
        <h3>1. Acceptance of Terms</h3>
        <p>By accessing our website, you acknowledge and agree to comply with these terms of service. If you do not agree, please refrain from using our site.</p>
        
        <h3>2. Use of Services</h3>
        <p>You agree to use our services responsibly and not engage in activities that could harm the site, its users, or violate applicable laws.</p>
        <ul>
            <li>Do not upload harmful or inappropriate content.</li>
            <li>Respect the intellectual property of others.</li>
            <li>Ensure the accuracy of the information you provide.</li>
        </ul>
      
        <h3>3. Intellectual Property</h3>
        <p>All content, logos, and designs on this site are the property of <span class="highlight">PAWSITIVE</span>. You may not reproduce or distribute any part of our content without prior written consent.</p>
      
        <h3>4. Limitations of Liability</h3>
        <p>We are not responsible for any damages resulting from the use of our site or services. Use our platform at your own discretion and risk.</p>
      
        <h3>5. Modifications to Terms</h3>
        <p>We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting. It is your responsibility to review these terms regularly.</p>
      
        <h3>6. Contact Information</h3>
        <p>If you have any questions about these terms, please <a href="about-us.php">Contact Us</a>.</p>
    </main>

    <?php include('templates/footer.php'); ?>
</body>
</html>
