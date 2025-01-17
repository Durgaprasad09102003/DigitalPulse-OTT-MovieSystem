<?php
require 'Db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['UName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phno']);
    $dob = mysqli_real_escape_string($conn, $_POST['Date']);
    $password = password_hash($_POST['Pwd1'], PASSWORD_DEFAULT);

    
    $usernameExists = false;
    $emailExists = false;
    $phoneExists = false;

    $checkSql = "SELECT * FROM logins WHERE Username='$username' OR Email='$email' OR PhoneNumber='$phone'";
    $checkResult = $conn->query($checkSql);

    while ($row = $checkResult->fetch_assoc()) {
        if ($row['Username'] === $username) {
            $usernameExists = true;
        }
        if ($row['Email'] === $email) {
            $emailExists = true;
        }
        if ($row['PhoneNumber'] === $phone) {
            $phoneExists = true;
        }
    }

    
    $alertMessage = "";
    if ($usernameExists) {
        $alertMessage .= "Username already exists. ";
    }
    if ($emailExists) {
        $alertMessage .= "Email already exists. ";
    }
    if ($phoneExists) {
        $alertMessage .= "Phone number already exists. ";
    }

    if ($alertMessage) {
        echo "<script>
                alert('$alertMessage Please choose a different one.');
                window.history.back(); // Go back to the signup form
              </script>";
    } else {
        
        $sql = "INSERT INTO logins (Username, Email, DOB, PhoneNumber, Password) VALUES ('$username', '$email', '$dob', '$phone', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully.'); window.location.href = 'Login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

$conn->close();
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
    <div  class="container d-f jc-c ai-c fd-c zi-1">
        <header class="d-f jc-sb a-c fd-r zi-1">
            <div class="logo">
                <img src="../media/logo.jpg" alt="StreamVibe Logo">
                <h1>DIGITAL PULSE</h1>
            </div>
            <div class="d-f ai-c fd-r hammenu" id="menu">
                <a href="./Home.php"><button>Home</button></a>
                <a href="./Login.php"><button>Login</button></a>

            </div>
        </header/>
        <div class="overlay zi-0"></div>
        <section class="LoginContent zi-1"/>
            <h1> Join Us Today! </h1>
            <form action="Signup.php" method="POST" onsubmit="submitHandler" class="d-f fd-c jc-c ai-c">
                <h4 class="d-f">SignUp</h4>

                <table>
                    <tr>
                        <td><Label for="UName">Username:</Label></td>
                        <td><input type="text" name="UName" id="UName"  placeholder="Username" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="Email">E-mail:</Label></td>
                        <td><input type="email" name="Email" id="Email"  placeholder="Email" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="Date">DOB:</Label></td>
                        <td><input type="date" name="Date" id="Date"  placeholder="Date of birth" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="phno">Phone No:</Label></td>
                        <td><input type="tel" name="phno" id="phno"  placeholder="Phone Number" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="Pwd1">Password: </Label></td>
                        <td><input type="password" name="Pwd1" id="Pwd1"  placeholder="Password" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="Pwd2">Password: </Label></td>
                        <td><input type="password" name="Pwd2" id="Pwd2"  placeholder="Conform Password" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" placeholder="Submit" required /></td>
                    </tr>
                </table>
            </form>
        </section>

    </div>

    <script src="../js/Home.js"></script>
</body>
</html>