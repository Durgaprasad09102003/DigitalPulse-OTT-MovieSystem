<?php
session_start(); 
require 'DB.php';

$UserName = $_SESSION['username'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<?php
$movieId = isset($_GET['id']) ? $_GET['id'] : null;

if ($movieId) {$sql = "SELECT movietitle, movielink, description, movieLength, rating, category, certificate, cast, videosongs 
            FROM movielist WHERE id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $movieId); // Bind the movie ID to the query
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            // Fetch the movie data
            $row = $result->fetch_assoc();
            $movietitle = htmlspecialchars($row['movietitle']);
            $movielink = htmlspecialchars($row['movielink']); // Google Drive or video link
            $description = htmlspecialchars($row['description']);
            $movieLength = htmlspecialchars($row['movieLength']);
            $rating = htmlspecialchars($row['rating']);
            $category = htmlspecialchars($row['category']);
            $certificate = htmlspecialchars($row['certificate']);
            $cast = htmlspecialchars($row['cast']);
            $videosongs = $row['videosongs'];
        } else {
            echo "Movie not found.";
        }
        $stmt->close();
    } else {
        echo "Error preparing statement.";
    }
} else {
    echo "No movie ID provided.";
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
    <link rel="stylesheet" href="../css/moviePlay.css" />

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



<main class="d-f fd-c jc-c ai-c">
    <p id="name"><span></span><?php echo $UserName ; ?></p>
    
        <div class="d-f jc-se ai-c moviePos">
            <div class="d-f ai-c jc-c movielist">
                <iframe src="<?php echo $movielink; ?>"  
                    allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>
            </div>

            <div class="d-f fd-c jc-c ai-c movieDetails">
                <?php
                    echo '
                <h1>' . $movietitle . '</h1>
                <p>' . $description . '</p>
                <p>Movie Length: ' . $movieLength . '</p> 
                <p>Rating: ' . $rating . '</p>       
                <p>Category: ' . $category . '</p>
                <p>Certificate: ' . $certificate . '</p>
                <p>Cast: ' . $cast . '</p>
                ';?>
            </div>
        </div>
</main>


<section class="d-f fd-c jc-c ai-c">
    <h2>Video Songs</h2>
    
    <div class="videosongs d-g">
        <?php  echo  $videosongs; ?>
    </div>
    
</section>

<script src=""></script>

</body>
</html>
