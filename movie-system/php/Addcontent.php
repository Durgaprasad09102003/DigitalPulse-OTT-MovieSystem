<?php
require 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movietitle = mysqli_real_escape_string($conn, $_POST['movietitle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $movielength = mysqli_real_escape_string($conn, $_POST['movielength']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $certificate = mysqli_real_escape_string($conn, $_POST['certificate']);
    $movielink = mysqli_real_escape_string($conn, $_POST['movielink']); 
    $videosongs = mysqli_real_escape_string($conn, $_POST['videosongs']); 
    
    $categories = [];
    if (isset($_POST['category'])) {
        $categories = $_POST['category'];
    }
    $category_string = implode(", ", $categories);

    $sql = "INSERT INTO movielist (movietitle, Description, MovieLength, Rating, Category, Certificate, Cast, movielink, Videosongs) 
            VALUES ('$movietitle', '$description', '$movielength', '$rating', '$category_string', '$certificate', '$cast', '$movielink', '$videosongs')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Movie data added successfully!');
             window.location.href = 'movieList.php';
        </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
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
    <link rel="stylesheet" href="../css/Login.css" />
</head>
<body>
    <div class="container d-f jc-c ai-c fd-c zi-1">
        <header class="d-f jc-sb a-c fd-r zi-1">
            <div class="logo">
                <img src="../media/logo.jpg" alt="StreamVibe Logo">
                <h1>DIGITAL PULSE</h1>
            </div>
            <div class="d-f ai-c fd-r hammenu" id="menu">
                <a href="./Login.php"><button>Login</button></a>
            </div>
        </header>
        <div class="overlay zi-0"></div>
        <section class="LoginContent zi-1">
            <h1> ADD DATA </h1>
            <form action="AddContent.php" method="POST" class="d-f fd-c jc-c ai-c">
                <h4 class="d-f">movieDetails</h4>

                <table class="d-f fd-c jc-c ai-c">
                    <tr>
                        <td><label for="movietitle">Movie Title (Year):</label></td>
                        <td><input type="text" name="movietitle" id="movietitle" placeholder="Movie Title (Year)" required /></td>
                    </tr>
                    <tr>
                        <td><label for="movielink">MovieLink:</label></td>
                        <td><textarea name="movielink" id="movielink" placeholder="MovieLink" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="description">Description:</label></td>
                        <td><textarea name="description" id="description" placeholder="Movie Description" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="movielength">Movie Length:</label></td>
                        <td><input type="text" name="movielength" id="movielength" placeholder="Length in minutes" required /></td>
                    </tr>
                    <tr>
                        <td><label for="rating">Rating:</label></td>
                        <td><input type="text" name="rating" id="rating" placeholder="Rating (e.g., 4/5)" required /></td>
                    </tr>
                    <tr>
                        <td><label>Category:</label></td>
                        <td id="category">
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="action" value="action" />
                                <label for="action">Action</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="drama" value="drama" />
                                <label for="drama">Drama</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="comedy" value="comedy" />
                                <label for="comedy">Comedy</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="horror" value="horror" />
                                <label for="horror">Horror</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="sci-fi" value="sci-fi" />
                                <label for="sci-fi">Sci-Fi</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="romance" value="romance" />
                                <label for="romance">Romance</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="thriller" value="thriller" />
                                <label for="thriller">Thriller</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="animation" value="animation" />
                                <label for="animation">Animation</label>
                            </div>
                            <div class="checkbox-label d-f fd-r">
                                <input type="checkbox" name="category[]" id="documentary" value="documentary" />
                                <label for="documentary">Documentary</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="certificate">Certificate:</label></td>
                        <td>
                            <select name="certificate" id="certificate" required>
                                <option value="">Select Certificate</option>
                                <option value="U">U</option>
                                <option value="A">A</option>
                                <option value="U/A">U/A</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="cast">Cast:</label></td>
                        <td><input type="text" name="cast" id="cast" placeholder="Main Cast" required /></td>
                    </tr>
                    <tr>
                        <td><label for="videosongs">VideoSongs:</label></td>
                        <td><textarea name="videosongs" id="videosongs" placeholder="VideoSongs Links" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" /></td>
                    </tr>
                </table>
            </form>
        </section>
    </div>

    <script src="../js/Home.js"></script>
</body>
</html>
