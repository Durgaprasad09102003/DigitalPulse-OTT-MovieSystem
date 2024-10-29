<?php
session_start(); 

// Include your database connection
require 'DB.php'; // Adjust this path as needed

$UserName = $_SESSION['username'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGITAL PULSE</title>
    <link rel="icon" href="../media/home-bg.webp" />
    <link rel="stylesheet" href="../css/App.css" />
    <link rel="stylesheet" href="../css/Home.css" />
    <link rel="stylesheet" href="../css/movieList.css" />
</head>
<body>
    <header>
        <div class="logo">
            <img src="../media/logo.jpg" alt="StreamVibe Logo">
            <h1>DIGITAL PULSE</h1>
        </div>
        <nav class="menu">
            <a href="./LogOut.php">
                <button class="Logout" id="menuToggle">
                    Logout
                </button>
            </a>
        </nav>
    </header>

    <section class="d-f fd-c jc-c ai-c">
        <p id="name"><span></span><?php echo htmlspecialchars($UserName); ?></p>

        <h2>Now Showing</h2>
        <div class="shows d-g">
        <?php
            $sql = "SELECT id FROM movielist";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                     echo '<a href="moviePlay.php?id=' . urlencode($id) . '">';
                    echo '<img src="../media/movies/' . htmlspecialchars($id) . '.jpg" alt="Movie ' . htmlspecialchars($id) . '" />';
                    echo '</a>';
                }
            } else {
                echo '<p>No movies available.</p>'; // Message if no movies found
            }

            $conn->close();
        ?>

        </div>
    </section>

    <script src=""></script>
</body>
</html>
