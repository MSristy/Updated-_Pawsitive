<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - PAWSITIVE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
/*            min-height: 100vh;*/
            background-color: #f9f9f9;
        }
        main {
            flex: 1;
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2em;
            color: #009990;
            text-align: center;
            margin-bottom: 20px;
        }
        h3 {
            font-size: 1.5em;
            color: #333333;
            margin-top: 20px;
        }
        p, ul {
            font-size: 1em;
            color: #555555;
            margin-bottom: 20px;
            line-height: 1.8;
        }
        ul {
            padding-left: 20px;
            list-style-type: disc;
        }
        a {
            color: #009990;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
   footer {
    background-color: #009990; /* Footer background color */
    padding: 20px 10px; /* Space inside the footer */
    color: white; /* Text color for the footer */
    text-align: center;
    border-top: 1px solid #cccccc; /* Optional border */
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto; /* Center content */
}

.footer-links {
    margin-bottom: 10px;
}

.footer-links a {
    color: white; /* Ensure links are white to match the footer */
    text-decoration: none;
    margin: 0 10px;
}

.footer-links a:hover {
    text-decoration: underline; /* Add hover effect */
}

footer p {
    margin-top: 10px;
    font-size: 0.9em; /* Slightly smaller font size */
}

    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <main>
        <h2>Privacy Policy</h2>
        <p>Your privacy is important to us. This privacy policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p>

        <h3>Information We Collect</h3>
        <p>We may collect personal information that you provide to us when you register on our site, place an order, or contact us.</p>

        <h3>Use of Your Information</h3>
        <p>We may use the information we collect from you in the following ways:</p>
        <ul>
            <li>To improve our website</li>
            <li>To process transactions</li>
            <li>To send periodic emails regarding your order or other products and services</li>
        </ul>

        <h3>Disclosure of Your Information</h3>
        <p>We do not sell, trade, or otherwise transfer your personal information to outside parties without your consent.</p>

        <h3>Changes to Our Privacy Policy</h3>
        <p>We may update this privacy policy from time to time. We will notify you about significant changes in the way we treat personal information by sending a notice to the primary email address specified in your account.</p>
        <p>If you have any questions about this privacy policy, please <a href="About-us.php">Contact Us</a>.</p>
    </main>

     <?php include('templates/footer.php'); ?>
</body>
</html>
