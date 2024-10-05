<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Your actual MySQL password
$dbname = "personal_info"; // Updated database name
$port = 4306; // Updated port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to retain submitted values
$name = $email = $date_of_birth = $address = $bio = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $address = $conn->real_escape_string($_POST['address']);
    $bio = $conn->real_escape_string($_POST['bio']);

    // Insert query
    $sql = "INSERT INTO users (name, email, date_of_birth, address, bio) VALUES ('$name', '$email', '$date_of_birth', '$address', '$bio')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
    <link rel="stylesheet" href="date.css"> <!-- Link to the updated CSS file -->
</head>
<body>
    <div class="container">
        <h1>Enter Your Details</h1>
        <video autoplay muted loop class="background-video">
            <source src="css/Office_Background_Video(1080p).mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <form method="POST" action="">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="editable" value="<?php echo htmlspecialchars($name); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="editable" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="editable" value="<?php echo htmlspecialchars($date_of_birth); ?>" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="editable" value="<?php echo htmlspecialchars($address); ?>">

            <label for="bio">Biography</label>
            <textarea id="bio" name="bio" class="editable" rows="6" cols="50" style="width: 100%; height: 150px; resize: vertical;" required><?php echo htmlspecialchars($bio); ?></textarea>

            <button type="submit">Submit</button>
        </form>
        <br>
        <a href="coverpage.php"><button>BACK</button></a>
    </div>
</body>
</html>
