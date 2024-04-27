<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('./db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $user_type = $_POST['user_type'];

    if($password != $password2) {
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if(mysqli_query($conn, "INSERT INTO user(username,user_type,password) VALUES('" . $username . "','" . $user_type . "','" . md5($password) . "')")) {
        header("location: login.php");
        exit();
       } else { ?>
        
        <script>
        alert("error : Your name and password is wrong.")
    </script>
        
       <?php
       }

   mysqli_close($conn);
    
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
                <form  method="POST">
                    <h2 class="text-center pb-4 fw-bold">Create Account</h2>
                    <div class="form-group overflow-hidden pb-3">
                        <input type="text" name="username" id="username" placeholder="Enter Username"
                            class="form-input">
                    </div>
                    <div class="form-group overflow-hidden pb-3">
                        <input type="password" name="password" id="password" placeholder="Enter Password"
                            class="form-input">
                    </div>
                    <div class="form-group overflow-hidden pb-3">
                        <input type="password" name="password2" id="password2" placeholder="Confirm Password"
                            class="form-input">
                    </div>
                    <div class="form-group overflow-hidden pb-3">
                        <select name="user_type" id="user_type" class="form-input">
                            <option value="">--- Select Type ---</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                    <div class="form-group overflow-hidden pb-3 pt-4">
                        <input type="submit" name="register" id="register" class="form-submit text-center"
                            value="Sign Up">
                    </div>
                </form>
                <p class="loginhere">Have already an Account ?
                    <a href="login.php" class="login-link">Login Here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>