

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWSITIVE - Pet Adoption Platform</title>
    <link rel="stylesheet" href="styles.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>

header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background: linear-gradient(135deg,rgb(171, 219, 231),rgb(228, 205, 161));
        
        color: black;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
           <img src="images/logo1.jpg" alt="PAWSITIVE">
        </div>
        <nav class="nav">
            <ul class="nh">
                <li><a href="index.php"><b>Home</b></a></li>
                <li><a href="localPet.php"><b>Find Pets</b></a></li>               
                <li><a href="rehomers.php"><b>Rehomers</b></a></li>
                <li><a href="blog.php"><b>Blog</b></a></li>                           
                <li><a href="vatenary.php"><b>Vaterinary</b></a></li>
                <li><a href="marketplace.php"><b>MarketPlace</b></a></li>
                <li><a href="ways_to_help.php"><b>Donation</b></a></li>
                <!-- <li><a href="user_profile.php"><b>Profile</b></a></li> -->
                 <style>
                    li a i {
                        font-size: 24px; /* Icon size */
                        color: #000;     /* Icon color */
                        text-decoration: none; /* Remove underline */
                    }
                    li a:hover i {
                        color: #f39c12; /* Hover effect color */
                    }

                     li a i {
                        font-size: 24px; /* Icon size */
                        color: #000;     /* Icon color */
                        text-decoration: none; /* Remove underline */
                    }
                    li a:hover i {
                        color: #f39c12; /* Hover effect color */
                    }

                                .auth-buttons a i {
                            font-size: 18px;  /* Icon size */
                            margin-right: 8px;  /* Space between icon and text */
                        }

                        .auth-buttons a {
                            text-decoration: none; /* Remove underline */
                            display: inline-flex;
                            align-items: center;
                            padding: 8px 16px;
                        }

                        .auth-buttons a:hover {
                            background-color: #f39c12; /* Hover effect */
                            color: white;
                        }

                        .auth-buttons a i {
                            color: #000;  /* Icon color */
                        }

                        .auth-buttons a:hover i {
                            color: white; /* Icon color on hover */
                        }


                </style>
            </head>
            <body>
                  
                 <ul>
                    <li><a href="user_profile.php"><i class="fas fa-user"></i></a></li>
                </ul>

                <ul>
                    <li><a href="notification.php"><i class="fas fa-bell"></i></a></li>
                </ul>

                <!-- <ul>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
 -->
                        </ul>

                    </nav>
                    <nav>
                <div class="auth-buttons">
                    <!-- Login Button with Icon -->
                    <a href="login.php" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> <b>Login</b>
                    </a>

                    <!-- Logout Button with Icon -->
                    <a href="logout.php" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> <b>Logout</b>
                    </a>
                </div>
            </nav>

    </header>
    
</body>