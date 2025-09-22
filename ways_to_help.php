<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ways to Help</title>
  <link rel="stylesheet" href="ways_to_help.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      font-family: 'Arial', sans-serif;
      background-color: #e4edec;
      color: #333;
    }

    .container {
      flex: 1;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }

    p {
      font-size: 1.1rem;
      line-height: 1.8;
    }

    .section {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      background:rgb(210, 205, 201);
      border-radius: 20px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 40px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .section:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .white-card {
      background-color: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      width: 300px;
      height: 350px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      transition: transform 0.3s ease;
    }

    .white-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .white-card img {
      width: 100px;
      margin-bottom: 15px;
      border-radius: 10px;
    }

    .styled-button {
      background-color: #6c63ff;
      color: white;
      padding: 12px 25px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .styled-button:hover {
      background-color: #5a54e6;
      transform: translateY(-3px);
    }

    .grid-1 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      align-items: center;
    }

    .grid-1 img {
      max-width: 100%;
      height: auto;
      max-height: 600px;
      object-fit: cover;
      border-radius: 10px;
    }

    .grid-1 div ul {
      list-style-type: disc;
      padding-left: 20px;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      gap: 20px;
      margin-top: 50px;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 250px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .card-content {
      padding: 16px;
    }

    .card-content h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    footer {
      background: linear-gradient(135deg, rgb(105, 108, 109), rgb(104, 104, 110));
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: auto;
    }

    footer a {
      color: #d1d1d1;
      text-decoration: none;
    }

    footer a:hover {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php include('templates/header.php'); ?>

<div class="container">
  <h2>"Together We Can: Support a Better Tomorrow"</h2>
  
   <section class="grid-1">
    <figure>
      <img src="images/foster.jpg" alt="Adoption Banner">
    </figure>
    <div>
      <h2>How your donations help</h2>
      <ul>
        <li>Provide medical care and treatment for sick and injured animals.</li>
        <li>Help us build safe shelters for animals in need.</li>
        <li>Support adoption and foster programs for homeless pets.</li>
        <li>Assist in feeding and providing resources to animals.</li>
      </ul>
    </div>
  </section>


  <div class="section">
    <div class="white-card">
      <img src="images/Happy Pet 2.jpg" alt="Donate Icon">
      <h3>Donate</h3>
      <p>Your generous donations support animal care, medical treatment, and sheltering.</p>
      <a href="donation.php" class="styled-button">Donate</a>
    </div>
    <div class="white-card">
      <img src="images/stry.png" alt="Foster Icon">
      <h3>Foster</h3>
      <p>Open your home temporarily and provide love to animals awaiting adoption.</p>
      <a href="https://forms.gle/5iU4Yts1gJTApRsf6" class="styled-button">Apply</a>
    </div>
  </div>

 

  <div>
    <h2>How We Choose Foster Parents</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-content">
          <h3>Experience</h3>
          <p>We look for individuals with prior experience in handling pets and providing a loving environment.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <h3>Home Environment</h3>
          <p>We assess the home environment to ensure it is safe and suitable for fostering animals.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <h3>Commitment</h3>
          <p>Foster parents must demonstrate a commitment to caring for animals and supporting their needs.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-content">
          <h3>Availability</h3>
          <p>We ensure foster parents have the time and resources to care for pets throughout the fostering period.</p>
        </div>
      </div>
    </div>
  </div>
</div>

    <?php include('templates/footer.php'); ?>

</body>
</html>
