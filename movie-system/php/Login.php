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
                <a href="./Signup.php"><button>Sign Up</button></a>

            </div>
        </header/>
        <div class="overlay zi-0"></div>
        <section class="LoginContent zi-1"/>
            <h1> Welcome User </h1>
            <p><a href="./Forgot.php">forgot password?</a></p>
            <form onsubmit="submitHandler" class="d-f fd-c jc-c ai-c">
                <h4 class="d-f">Login</h4>

                <table>
                    <tr>
                        <td><Label for="UName">Username:</Label></td>
                        <td><input type="text" name="UName" id="UName"  placeholder="Enter your username" required /></td>
                    </tr>
                    <tr>
                        <td><Label for="Pwd">Password: </Label></td>
                        <td><input type="password" name="Pwd" id="Pwd"  placeholder="Enter Password" required /></td>
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