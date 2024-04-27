<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
session_start();
include('./db_connect.php');

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
} else {
    $user_id = $_SESSION["user_id"];
    $query = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if ($user['user_type'] !== 'customer') {
            header("Location: login.php"); 
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

    <div class="header-section">
        <div class="container-fluid">
            <nav class="navbar navbar-extend-lg navbar-light">
                <a class="navbar-brand" href="home.php">
                    <h2><b>FootFlex</b></h2>
                </a>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="header-background">
        <div class="container-fluid">
            <div class="banner-title">
                <h1>
                    Genuine <br>
                    Shoes online Shopping
                </h1>
                <p>Step into Style: Explore Our Collection of Trendsetting Footwear!</p>
            </div>
            <div class="shop-btn">
                <a href="shop.html">Shop Now</a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="about-title">
                    About Our Shop
                </h1>
                <p class="about-para">
                    At FootFlex, we're passionate about footwear that speaks volumes about style, comfort, and quality.
                    With an eye for the latest trends and a commitment to exceptional craftsmanship, our curated
                    collection offers an array of shoes designed to elevate your every step. Whether you're seeking
                    casual kicks, elegant heels, or sporty sneakers, our diverse range ensures there's something for
                    every occasion and personality. Discover the perfect pair that merges fashion with functionality,
                    only at FootFlex.
                </p>
                <div class="read-btn">
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="imgs/img-1.png" alt="about image">
            </div>
        </div>
    </div>

    <div class="container news pb-5">
        <h1 class="text-center">Best Quality</h1>
        <p class="text-center">It is a long established fact that a reader will be distracted by the readable content
        </p>
        <div class="row pt-5">
            <div class="col-lg-4 col-sm-12">
                <img src="imgs/img-6.png" alt="news - 1">
                <h5 class="fw-bold py-2">Fall Fashion Finesse: Embrace the Season with Our Latest Collection!</h5>
                <p class="p-0 m-0">
                    As autumn hues paint the landscape, our new collection arrives, capturing the essence of the season
                    in every pair. From rich earthy tones to cozy textures, explore footwear that complements the crisp
                    air and changing leaves. Elevate your fall wardrobe with our must-have picks, blending style and
                    warmth effortlessly.
                </p>
                <div class="news-btn">
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <img src="imgs/img-7.png" class="pt-5" alt="news - 2">
                <h5 class="fw-bold py-2">Fall Fashion Finesse: Embrace the Season with Our Latest Collection!</h5>
                <p class="p-0 m-0">
                    As autumn hues paint the landscape, our new collection arrives, capturing the essence of the season
                    in every pair. From rich earthy tones to cozy textures, explore footwear that complements the crisp
                    air and changing leaves. Elevate your fall wardrobe with our must-have picks, blending style and
                    warmth effortlessly.
                </p>
                <div class="news-btn">
                    <a href="#">Read More</a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <img src="imgs/img-8.png" alt="news - 3">
                <h5 class="fw-bold py-2">Fall Fashion Finesse: Embrace the Season with Our Latest Collection!</h5>
                <p class="p-0 m-0">
                    As autumn hues paint the landscape, our new collection arrives, capturing the essence of the season
                    in every pair. From rich earthy tones to cozy textures, explore footwear that complements the crisp
                    air and changing leaves. Elevate your fall wardrobe with our must-have picks, blending style and
                    warmth effortlessly.
                </p>
                <div class="news-btn">
                    <a href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fliud letter">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="fw-bolder fs-1">Newsletter</h1>
                    <input type="text" class="letter-input w-100" placeholder="Enter Your Email">
                </div>
                <div class="col-md-4">
                    <div class="social-icon">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="imgs/fb-icon.png" alt="facebook icon">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="imgs/instagram-icon.png" alt="facebook icon">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="imgs/linkedin-icon.png" alt="facebook icon">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="imgs/twitter-icon.png" alt="facebook icon">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sub-btn float-end">
                        <a href="#">SUBSCRIBE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h1>
                        useful links
                    </h1>
                    <ul>
                        <li>
                            <img src="imgs/icons8-right-arrow-26.png" alt="arrow">
                            <a href="home.html">Home</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-right-arrow-26.png" alt="arrow">
                            <a href="shop.html">Shop</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-right-arrow-26.png" alt="arrow">
                            <a href="home.html">Orders</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-right-arrow-26.png" alt="arrow">
                            <a href="home.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h1>Social Links</h1>
                    <ul>
                        <li>
                            <img src="imgs/icons8-facebook-50.png" alt="arrow" width="30">
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-instagram-50.png" alt="arrow" width="30">
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-linked-in-50.png" alt="arrow" width="30">
                            <a href="#">Linked In</a>
                        </li>
                        <li>
                            <img src="imgs/icons8-twitterx-50.png" alt="arrow" width="30">
                            <a href="#">Twitter X</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h1 class="grp-mbr">group members</h1>
                        <p>Krunal Chhabhaya - 8890229</p>
                        <p>Priyanshu Kumar Bhardwaj - 8828610</p>
                        <p>Faizansayeed Mohammed - 8878625</p>
                        <p>Sahil Sharma - 8903063</p>

                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>