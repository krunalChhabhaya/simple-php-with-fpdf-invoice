<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('./db_connect.php');
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $row  = mysqli_fetch_array($result);
    var_dump($row);

    if (is_array($row)) {
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["username"] = $row['username'];
    
        if ($row['user_type'] == 'admin') {
            header("location: dashboard.php");
            exit(); 
        } else if ($row['user_type'] == 'customer') {
            header("location: home.php");
            exit(); 
        } else {
            header("location: default.php");
            exit();
        }
    }  else {
        $message = "Invalid Username or Password!";
?>
        <script>
            alert("error : Your name and password are wrong.")
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Sen:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="sign-form">
                <form method="POST" action="login.php">
                    <h2 class="text-center pb-4 fw-bold">Log In</h2>
                    <div class="form-group overflow-hidden pb-3">
                    <input type="text" name="username" id="username" placeholder="Enter Username" class="form-input">
                    </div>
                    <div class="form-group overflow-hidden pb-3">
                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-input">
                    </div>
                    <div class="form-group overflow-hidden pb-3 pt-4">
                    <input type="submit" name="login" id="login" class="form-submit text-center" value="Log In">
                    </div>
                </form>
                <p class="loginhere">Don't Have an Account ?
                    <a href="register.php" class="login-link">Register Here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>