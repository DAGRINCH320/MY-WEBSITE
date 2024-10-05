<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="date.css"> <!-- Link to your CSS file -->
    <style>
        body {
            margin: 0;
            padding: 0;
            position: relative;
            overflow: hidden;
            height: 100vh; /* Ensure body takes full height */
        }

        

        .contacts {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .social-icons img {
            width: 40px; /* Adjust size of icons */
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="background-video">
        <video autoplay muted loop>
            <source src="css/Office_Background_Video(1080p).mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="contacts">
        <h1>Contact Me</h1>
        <p>Follow me on social media:</p>
        <div class="social-icons">
            <a href="https://wa.me/your-number" target="_blank">
                <img src="images/whatsapp-logo.png" alt="WhatsApp">
            </a>
            <a href="https://facebook.com/your-page" target="_blank">
                <img src="images/facebook-logo.png" alt="Facebook">
            </a>
            <a href="https://instagram.com/your-profile" target="_blank">
                <img src="images/instagram-logo.png" alt="Instagram">
            </a>
            <a href="https://linkedin.com/in/your-profile" target="_blank">
                <img src="images/linkedin-logo.png" alt="LinkedIn">
            </a>
        </div>
    </div>
    <a href="coverpage.php"><button>BACK</button></a>
</body>
</html>
