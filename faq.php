<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'paw');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request to get the answer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['get_answer'])) {
    $faq_id = $conn->real_escape_string($_POST['faq_id']);
    $sql = "SELECT answer FROM faqs WHERE id = $faq_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $answer = $result->fetch_assoc()['answer'];
        echo json_encode(['answer' => $answer]);
    } else {
        echo json_encode(['answer' => 'No answer available.']);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PAWSITIVE</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
            color: #333;
        }

        main {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            color: #4a90e2;
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .faq-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
        }

        .faq-list {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .faq-list:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .faq-item {
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #f4f4f9;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .faq-item:hover {
            background-color: #e3ecfa;
            transform: translateY(-3px);
        }

        .faq-item h3.question {
            margin: 0;
            color: #4a90e2;
            font-size: 18px;
            font-weight: bold;
        }

        #chat-box {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 10px;
            display: none;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        #chat-box h4 {
            margin: 10px 0;
            color: #4a90e2;
            font-weight: bold;
        }

        #chat-box p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        #chat-box button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        #chat-box button:hover {
            background-color: #357ab8;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        footer {
            background-color: #4a90e2;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto; /* Ensures the footer is pushed to the bottom */
        }

        footer a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }


            </style>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <main>
        <h2>Frequently Asked Questions</h2>

        <div class="faq-container">
            <!-- FAQ List -->
            <div class="faq-list">
                <?php
                // Fetch FAQs from the database
                $sql = "SELECT id, question FROM faqs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output each FAQ
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='faq-item' data-id='" . $row['id'] . "'>";
                        echo "<h3 class='question'>" . $row['question'] . "</h3>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No FAQs available at the moment.</p>";
                }
                ?>
            </div>

            <!-- Chat Box -->
            <div id="chat-box">
                <h4>Question:</h4>
                <p id="chat-question"></p>
                <h4>Answer:</h4>
                <p id="chat-answer"></p>
                <button id="close-chat">Close</button>
            </div>
        </div>
    </main>
    

     <?php include('templates/footer.php'); ?>


    <script>
    $(document).ready(function() {
        // Handle FAQ click to fetch and show answer
        $('.faq-item').click(function() {
            var faqId = $(this).data('id');
            var questionText = $(this).find('.question').text();

            // Show question in chat box
            $('#chat-question').text(questionText);
            
            // Fetch the answer via AJAX
            $.ajax({
                type: 'POST',
                url: 'faq.php',
                data: { faq_id: faqId, get_answer: true },
                dataType: 'json',
                success: function(response) {
                    $('#chat-answer').text(response.answer);
                    $('#chat-box').fadeIn(); // Smoothly show chat box with the answer
                }
            });
        });

        // Handle close button for chat box
        $('#close-chat').click(function() {
            $('#chat-box').fadeOut(); // Smoothly hide the chat box
        });
    });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
