<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "skills"; // Updated database name
$port = 4306; // Change the port to 4306 if needed

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a skill
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_skill'])) {
    $name = $_POST['skill_name'];
    $description = $_POST['skill_description'];

    $stmt = $conn->prepare("INSERT INTO skills (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();
}

// Handle deletion of a skill
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch all skills
$result = $conn->query("SELECT * FROM skills");
$skills = $result->fetch_all(MYSQLI_ASSOC);

// Define colors
$colors = ['#ffadad', '#ffd6a5', '#fdffb6', '#caffbf', '#9bfbcf', '#a0c4ff', '#b9fbc0', '#ffc3a0'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Skills Portfolio</title>
    <link rel="stylesheet" href="date.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        main {
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        #skills {
            text-align: center;
        }
        .skills-container {
            display: flex; /* Use Flexbox for layout */
            flex-wrap: wrap; /* Allow items to wrap */
            justify-content: center; /* Center the items */
        }
        .skill-box {
            display: flex;
            flex-direction: column; /* Align text vertically */
            margin: 10px;
            padding: 20px;
            border-radius: 15px;
            color: white;
            width: 150px; /* Adjust width */
            height: 100px; /* Adjust height */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            justify-content: space-between; /* Space between content */
        }
        .skill-box:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop class="background-video">
            <source src="css/Office_Background_Video(1080p).mp4" type="video/mp4"> <!-- Update video path -->
            Your browser does not support the video tag.
        </video>
    </div>

    <main>
        <section id="skills">
            <h1>My Skills</h1>
            <form method="POST">
                <input type="text" name="skill_name" placeholder="Skill Name" required>
                <textarea name="skill_description" placeholder="Skill Description" required></textarea>
                <button type="submit" name="add_skill">Add Skill</button>
            </form>
            <div class="skills-container">
                <?php foreach ($skills as $index => $skill): ?>
                    <div class="skill-box" style="background-color: <?php echo $colors[$index % count($colors)]; ?>;">
                        <h2><?php echo htmlspecialchars($skill['name']); ?></h2>
                        <p><?php echo htmlspecialchars($skill['description']); ?></p>
                        <a href="?delete=<?php echo $skill['id']; ?>" style="color: white;">Delete</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <br><a href="coverpage.php"><button>BACK</button></a>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
