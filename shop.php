<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('./db_connect.php'); 

$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Sen:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="shop.php">Shop</a>
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
                <a href="#">Shop Now</a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-3 mb-4">
                    <a href="product_details.php?product_id=<?php echo $row['product_id']; ?>" class="card-link">
                        <div class="card">
                            <img src="<?php echo $row['product_img']; ?>" class="card-img-top1" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                <p class="card-text">Price: $<?php echo $row['price']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>