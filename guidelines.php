<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSITIVE Adoption Guidelines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        main {
            flex: 1;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        section {
            margin-bottom: 30px;
        }
        .banner {
            background-color: #f0f0f0;
            padding: 30px;
            text-align: center;
        }
        .banner .content h2 {
            margin: 0;
            font-size: 2em;
            color: #333;
        }
        .grid-1, .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: center;
        }
        .grid-1 img, .grid-2 img {
            max-width: 100%;
            height: auto;
            max-height: 800px;
            object-fit: cover;
            border-radius: 10px;
        }
        .grid-1 div, .grid-2 div {
            padding: 10px;
        }
        .grid-1 div ul, .grid-2 div ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .grid-1 div h2, .grid-2 div h3 {
            margin-top: 0;
            color: #009990;
        }
        footer {
            background-color: #009990;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #ccc;
            color: white;
        }
        /* Responsive design for smaller devices */
        @media (max-width: 768px) {
            .grid-1, .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <main>
        <!-- Banner Section -->
        <section class="banner">
            <div class="content">
                <h2>Information for Adopters</h2>
            </div>
        </section>

        <!-- Guidelines Overview -->
        <section class="grid-1">
            <figure>
                <img src="images/d.png" alt="Adoption Banner">
            </figure>
            <div>
                <h2>Adoption Guidelines</h2>
                <p>
                    To adopt, you must:
                </p>
                <ul>
                    <li>Be 18 years or older.</li>
                    <li>Provide identification showing your current address.</li>
                    <li>Have landlord consent if renting (proof of lease agreement required).</li>
                    <li>Be willing to invest time and money for training, medical treatment, and proper care of the pet.</li>
                </ul>
            </div>
        </section>

        <section class="grid-2">
            <figure>
                <img src="images/x.png" alt="Pet Care">
            </figure>

            <div>
            <h3>How Old is Your Pet in Human Years?</h3>
            <ul>
                <li><strong>What is the general rule?</strong> For dogs, the common rule is that one dog year equals seven human years, but this varies by breed and size.</li>
                <li><strong>How does it differ for cats?</strong> Cats age more rapidly in their first two years—equivalent to about 24 human years—then approximately four human years per cat year thereafter.</li>
                <li><strong>What about birds?</strong> Birds have varied lifespans depending on species. Smaller birds like budgies may live 5–10 years (roughly 1 bird year = 5–10 human years), while larger birds like parrots can live 50+ years, aging at a slower pace compared to humans.</li>
                <li><strong>What about other pets?</strong> Small animals like rabbits or hamsters age much faster than dogs or cats, while larger animals like horses age more slowly.</li>
                <li><strong>Are there tools to calculate this?</strong> Yes! Online calculators can help you estimate your pet's age in human years based on species, breed, and size.</li>
                <li><strong>Why is this important?</strong> Knowing your pet's age in human years helps in understanding their life stage and care needs, such as diet, exercise, and medical attention.</li>
            </ul>
            </div>
        </section>

        <!-- Detailed Guidelines -->
        <section class="grid-2">
            <figure>
                <img src="images/trio.png" alt="Pet Care">
            </figure>
            <div>
                <h3>Important Considerations:</h3>
                <ul>
                    <li>Maintain good communication with adopters to address post-adoption issues.</li>
                    <li>Screen and assess each dog's suitability for rehoming, including behavioral history.</li>
                    <li>Use objective tools like the Dunbar Dog Bite Scale for aggression assessment.</li>
                    <li>Disclose all medical and behavioral conditions to stakeholders.</li>
                    <li>Provide robust pre-adoption screening, processes, and post-adoption support.</li>
                    <li>Educate adopters on animal health, behavior, socialization, and training.</li>
                    <li>Clearly communicate adoption agreement clauses early to set expectations.</li>
                </ul>
            </div>
        </section>
    </main>

    <?php include('templates/footer.php'); ?>
</body>
</html>
