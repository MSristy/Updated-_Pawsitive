
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="style_notifications.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
            z-index: 10;
        }

        .notification-banner {
            background: #005477;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .notifications {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 20px;
            flex-grow: 1;
        }

        .notification {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 15px;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .notification:hover {
            transform: scale(1.05);
        }

        .notification i {
            font-size: 2rem;
            margin-right: 15px;
            color: #007bff;
        }

        .notification div {
            flex-grow: 1;
        }

        .notification h2 {
            font-size: 1.2rem;
            margin: 0;
            color: #333;
        }

        .notification p {
            font-size: 1rem;
            margin: 5px 0 0;
            color: #666;
        }

        .new-notification {
            font-size: 1.2rem;
            color: #ff6347;
            font-weight: bold;
        }

        .notification-time {
            font-size: 0.9rem;
            color: #999;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <main>
        <section class="notification-banner">
            <h1>Notifications</h1>
        </section>
        
        <section class="notifications">
            <!-- Example notifications, dynamically generated from PHP will be added here -->
            <div class="notification">
                <i class="fas fa-paw"></i>
                <div>
                    <h2>Adoption Update <span class="new-notification">New</span></h2>
                    <p>Adoption form is in review.</p>
                    <div class="notification-time">Posted 2 hours ago</div>
                </div>
            </div>

            <div class="notification">
                <i class="fas fa-paw"></i>
                <div>
                    <h2>Vaccination Update</h2>
                    <p>Your pet's vaccination is due.</p>
                    <div class="notification-time">Posted 1 day ago</div>
                </div>
            </div>

            <div class="notification">
                <i class="fas fa-paw"></i>
                <div>
                    <h2>New Pet Alert</h2>
                    <p>A new pet has arrived in the shelter. Will you have a look?</p>
                    <div class="notification-time">Posted 3 days ago</div>
                </div>
            </div>
        </section>
    </main>

    <?php include('templates/footer.php'); ?>
    
    <script>
        // Example real-time notifications with JavaScript using setInterval to mimic new notifications
        setInterval(function() {
            const notificationContainer = document.querySelector('.notifications');
            const newNotification = document.createElement('div');
            newNotification.classList.add('notification');
            newNotification.innerHTML = `
                <i class="fas fa-paw"></i>
                <div>
                    <h2>New Adoption Request</h2>
                    <p>You have a new adoption request to review.</p>
                    <div class="notification-time">Just now</div>
                </div>
            `;
            notificationContainer.prepend(newNotification);
        }, 5000); // New notification every 5 seconds (for demonstration)
    </script>
</body>
</html>
