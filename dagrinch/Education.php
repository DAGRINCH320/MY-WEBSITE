<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "education"; // Your database name
$port = 4306; // New port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id']; // Assuming user_id is provided
    $university = $_POST['university'];
    $high_school = $_POST['high_school'];
    $highest_grade_passed = $_POST['highest_grade_passed'];
    $degree = $_POST['degree'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO educational_background (user_id, university, high_school, highest_grade_passed, degree) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $user_id, $university, $high_school, $highest_grade_passed, $degree);

    if ($stmt->execute()) {
        echo "<script>alert('Record created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close(); // Close the prepared statement
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="date.css">
    <meta charset="UTF-8" />
    <title>Document</title>
    <style>
        .editable {
            /* Add your styles here */
        }
    </style>
</head>
<body>
<h2>EDUCATION</h2>

<form method="POST">
    <label for="university">UNIVERSITY OF</label><br>
    <input type="text" id="university" name="university" class="editable" value="LIMPOPO" required><br>
    <label for="high_school">HIGH SCHOOL</label><br>
    <input type="text" id="high_school" name="high_school" class="editable" value="ST AUGUSTINE RESIDENTIAL SCHOOL" required><br>
    <label for="highest_grade_passed">HIGHEST GRADE</label><br>
    <input type="number" id="highest_grade_passed" name="highest_grade_passed" class="editable" value="12" required><br>
    <label for="degree">DEGREE</label><br>
    <input type="text" id="degree" name="degree" class="editable" value="BSC MATHEMATICAL SCIE" required><br>
    <input type="hidden" name="user_id" value="1"> <!-- Example user_id, adjust as needed -->
    <br><button type="submit">Submit</button>
</form>

<br><a href="coverpage.php"><button>BACK</button></a>
<div class="background-image"></div>
</body>
</html>
