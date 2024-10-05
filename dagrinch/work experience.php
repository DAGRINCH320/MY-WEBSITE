<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Your actual MySQL password
$dbname = "experiences"; // Your database name
$port = 4306; // Updated port number

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding experience
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO experiences (title, company, start_date, end_date, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $company, $start_date, $end_date, $description);
    $stmt->execute();
}

// Handle deletion of experience
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM experiences WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch all experiences
$result = $conn->query("SELECT * FROM experiences");
$experiences = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Experience</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: white; /* Change text color to white for better contrast */
            position: relative;
            overflow: hidden;
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1; /* Bring the container above the video */
        }

        h1, h2 {
            text-align: center;
        }

        .experience {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .delete {
            color: red;
            cursor: pointer;
        }

        form input, form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8); /* Light background for inputs */
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="background-video">
        <source src="css/Office_Background_Video(1080p).mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <h1>Work Experience</h1>

        <form method="POST">
            <input type="text" name="title" placeholder="Job Title" required>
            <input type="text" name="company" placeholder="Company Name" required>
            <input type="date" name="start_date" required>
            <input type="date" name="end_date" required>
            <textarea name="description" placeholder="Job Description" required></textarea>
            <button type="submit" name="add">Add Experience</button>
        </form>

        <h2>Current Experiences</h2>
        <?php foreach ($experiences as $experience): ?>
            <div class="experience">
                <strong><?php echo htmlspecialchars($experience['title']); ?></strong> at <?php echo htmlspecialchars($experience['company']); ?><br>
                <?php echo htmlspecialchars($experience['start_date']); ?> - <?php echo htmlspecialchars($experience['end_date']); ?><br>
                <p><?php echo htmlspecialchars($experience['description']); ?></p>
                <a class="delete" href="?delete=<?php echo $experience['id']; ?>">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
    <br><a href="coverpage.php"><button>BACK</button></a>
</body>
</html>
<script src="script.js"></script>
<?php
// Close the connection
$conn->close();
?>
