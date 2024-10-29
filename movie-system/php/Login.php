<?php
session_start();
require 'Db.php'; // Assuming 'Db.php' includes the database connection setup.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['UName']);
    $password = $_POST['Pwd'];

    $sql = "SELECT * FROM logins WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            // Check if the username is "Durgaprasad"
            if ($username === 'Durgaprasad') {
                header("Location: AddContent.php");
            } else {
                header("Location: movieList.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
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
        <header class="d-f jc-sb ai-c fd-r zi-1">
            <div class="logo">
                <img src="../media/logo.jpg" alt="StreamVibe Logo">
                <h1>DIGITAL PULSE</h1>
            </div>
            <div class="d-f ai-c fd-r hammenu" id="menu">
                <a href="./Home.php"><button>Home</button></a>
                <a href="./Signup.php"><button>Sign Up</button></a>
            </div>
        </header>

        <div class="overlay zi-0"></div>

        <section class="LoginContent zi-1">
            <h1>Welcome User</h1>
            <p><a href="./Forgot.php">Forgot password?</a></p>
            <form onsubmit="return submitHandler();" method="POST" action="login.php" id="loginForm" class="d-f fd-c jc-c ai-c">
                <h4 class="d-f">Login</h4>
                <table>
                    <tr>
                        <td><label for="UName">Username:</label></td>
                        <td><input type="text" name="UName" id="UName" placeholder="Enter your username" required /></td>
                    </tr>
                    <tr>
                        <td><label for="Pwd">Password:</label></td>
                        <td><input type="password" name="Pwd" id="Pwd" placeholder="Enter Password" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" /></td>
                    </tr>
                </table>
            </form>
        </section>
    </div>

    <script src="../js/Login.js"></script>
</body>
</html>