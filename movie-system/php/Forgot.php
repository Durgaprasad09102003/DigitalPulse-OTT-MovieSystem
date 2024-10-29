<?php
session_start();
require 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['UName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phno']);
    $dob = mysqli_real_escape_string($conn, $_POST['Date']);
    $changePassword = $_POST['CPwd'];

    
    $sql = "SELECT * FROM logins WHERE Username='$username' AND Email='$email' AND PhoneNumber='$phone' AND DOB='$dob'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($changePassword === "Yes") {
            
            $newPassword = $_POST['Pwd1'];
            $confirmPassword = $_POST['Pwd2'];

            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                
                $updateSql = "UPDATE logins SET Password='$hashedPassword' WHERE Username='$username'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "<script>alert('Password updated successfully.');
                        window.location.href='Login.php';
                    </script>";
                    exit();
                } else {
                    echo "<script>alert('Error updating password.');</script>";
                }
            } else {
                echo "<script>alert('Passwords do not match.');</script>";
            }
        } else if ($changePassword === "No") {
            echo "<script>
                alert('Your password is securely hashed and cannot be displayed.');
                window.location.href='Forgot.php';
                </script>";
            exit();
        }
    } else {
        echo "<script>alert('User details not found. Please check your information.');</script>";
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
    <link rel="stylesheet" href="../css/Forgot.css" />
</head>
<body>
    <div class="container d-f jc-c ai-c fd-c zi-1">
        <header class="d-f jc-sb ai-c fd-r zi-1">
            <div class="logo">
                <img src="../media/logo.jpg" alt="StreamVibe Logo">
                <h1>DIGITAL PULSE</h1>
            </div>
            <div class="d-f ai-c fd-r hammenu" id="menu">
                <a href="./Login.php"><button>Login</button></a>
                <a href="./Signup.php"><button>Sign Up</button></a>
            </div>
        </header>
        <div class="overlay zi-0"></div>
        <section class="LoginContent zi-1">
            <h1>Reset Password</h1>
            <p></p>
            <form action="Forgot" method="POST" onsubmit="submitHandler(event)" class="d-f fd-c jc-c ai-c">
                <h4 class="d-f">Forgot password</h4>
                <table>
                    <tr>
                        <td><label for="UName">Username:</label></td>
                        <td><input type="text" name="UName" id="UName" placeholder="Enter your username" required /></td>
                    </tr>
                    <tr>
                        <td><label for="Email">E-mail:</label></td>
                        <td><input type="email" name="Email" id="Email" placeholder="Email" required /></td>
                    </tr>
                    <tr>
                        <td><label for="phno">Phone No:</label></td>
                        <td><input type="tel" name="phno" id="phno" placeholder="Phone Number" required /></td>
                    </tr>
                    <tr>
                        <td><label for="Date">DOB:</label></td>
                        <td><input type="date" name="Date" id="Date" placeholder="Date of birth" required /></td>
                    </tr>
                    <tr>
                        <td><label for="CPwd">Change Password:</label></td>
                        <td class="d-f fd-r jc-se ai-c">
                            <label>Yes</label><input type="radio" id="CPwdYes" value="Yes" onclick="togglePasswordFields(true)" name="CPwd" required />
                            <label>No</label><input type="radio" id="CPwdNo" value="No" onclick="togglePasswordFields(false)" name="CPwd" required />
                        </td>
                    </tr>
                    <tr class="op-Yes" id="passwordFields" style="display: none;">
                        <td><input type="password" name="Pwd1" id="Pwd1" placeholder="Password" /></td>
                        <td><input type="password" name="Pwd2" id="Pwd2" placeholder="Confirm Password" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" /></td>
                    </tr>
                </table>
            </form>
        </section>
    </div>

    <script src="../js/Forgot.js"></script>
</body>
</html>