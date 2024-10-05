<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Your actual MySQL password
$dbname = "new"; // Your database name
$port = 4306; // Updated port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_input = htmlspecialchars(trim($_POST['username']));

    // Validate username (you can add more checks as necessary)
    if (!empty($username_input)) {
        // Redirect to cover page with username in the session (or you can use other methods)
        header("Location: coverpage.php?username=" . urlencode($username_input));
        exit();
    } else {
        $error = "Username cannot be empty.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="date.css">
    <title>Homepage</title>
</head>

<body>
    <h1>WORLD OF WORK</h1>
    <p class="caption">A FUTURE TO BUILD</p>
    <p>YOU CHOOSE THE ADVENTURE WE MAKE IT HAPPEN</p>

    <h2>HELLO WELCOME</h2>

    <video autoplay muted loop class="background-video">
        <source src="css/Smart_City_Digital_City_Video(1080p).mp4" type="video/mp4">
    </video>

    <div class="container">
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Enter Username" required>
            <br><button type="submit">Log In</button>
        </form>
        
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <footer>
            <p>&copy; 2024 Your Website. All rights reserved.</p>
        </footer>
        
        <br>
        <button><a href="coverpage.php">SIGN IN</a></button>
    </div>
</body>
</html>
