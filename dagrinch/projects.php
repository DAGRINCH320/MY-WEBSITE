<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "projects"; // Your database name
$port = 4306; // Change the port if needed

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a project
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project'])) {
    $name = $_POST['project_name'];
    $description = $_POST['project_description'];

    $stmt = $conn->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();
}

// Handle deletion of a project
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch all projects
$result = $conn->query("SELECT * FROM projects");
$projects = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="date.css">
    <meta charset="UTF-8" />
    <title>Project Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        .projects-container {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping to the next line */
            justify-content: center; /* Center the items */
        }
        .project-box {
            width: 150px; /* Set a fixed width */
            height: 80px; /* Set a fixed height for the rectangle */
            margin: 10px; /* Space between projects */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            transition: background-color 0.3s; /* Smooth transition for color change */
            overflow: hidden; /* Prevent overflow */
            padding: 5px; /* Add some padding */
            box-sizing: border-box; /* Include padding in width/height */
        }

        /* Curved Rectangle */
        .project-box.rectangle {
            border-radius: 20px; /* Create a curved rectangle */
            background-color: #3498db; /* Default color */
        }

        /* Cylinder */
        .project-box.cylinder {
            height: 150px; /* Adjust height for cylinder */
            border-radius: 75px; /* Create a cylinder form */
            background-color: #2ecc71; /* Different color for visibility */
        }

        .project-box:hover {
            background-color: #2980b9; /* Change color on hover */
        }

        /* Ensure text fits and wraps */
        h2, p {
            font-size: 14px; /* Adjust font size if needed */
            margin: 0; /* Remove default margin */
            overflow-wrap: break-word; /* Break long words */
            word-wrap: break-word; /* Break long words */
            hyphens: auto; /* Optional: allow hyphenation */
        }
    </style>
</head>
<body>
<div class="background-image"></div>

    <h1>My Projects</h1>
    <form method="POST">
        <input type="text" name="project_name" placeholder="Project Name" required>
        <textarea name="project_description" placeholder="Project Description" required></textarea>
        <button type="submit" name="add_project">Add Project</button>
    </form>

    <div class="projects-container">
        <?php foreach ($projects as $index => $project): ?>
            <div class="project-box <?php echo $index % 2 == 0 ? 'rectangle' : 'cylinder'; ?>" style="background-color: <?php echo '#' . substr(md5(rand()), 0, 6); ?>;">
                <h2><?php echo htmlspecialchars($project['name']); ?></h2>
                <p><?php echo htmlspecialchars($project['description']); ?></p>
                <a href="?delete=<?php echo $project['id']; ?>" style="color: white;">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>

    <br>
    <a href="coverpage.php"><button>BACK</button></a>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
