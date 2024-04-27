<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('db_connect.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $query = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product_details = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found!";
    }
} else {
    echo "Product ID is missing!";
}
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
                            <a class="nav-link text-black" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="order.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-6">
                <img src="<?php echo $product_details['product_img']; ?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2><?php echo $product_details['product_name']; ?></h2>
                <p>Description: <?php echo $product_details['description']; ?></p>
                <p>Price: $<?php echo $product_details['price']; ?></p>
                <div class="mb-3 w-25">
        <label for="size" class="form-label">Select Size:</label>
        <select id="size" name="size" class="form-select" required>
        <option value="" selected disabled>Select Size</option>
            <?php
            $query_sizes = "SELECT s.size FROM size s INNER JOIN size_has_product sp ON s.size_id = sp.size_size_id WHERE sp.product_product_id = $product_id";
            $result_sizes = mysqli_query($conn, $query_sizes);
            if ($result_sizes && mysqli_num_rows($result_sizes) > 0) {
                while ($size = mysqli_fetch_assoc($result_sizes)) {
                    echo "<option value='" . $size['size'] . "'>" . $size['size'] . "</option>";
                }
            }
            ?>
        </select>
    </div>
                <div class="mb-3 w-25">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="checkout.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_details['product_id']; ?>">

                        <input type="hidden" id="modalQuantity" name="modal_quantity" value="1">

                        <input type="hidden" id="modalSize" name="modal_size">

                        <div class="mb-3">
                            <label>Total Price:</label>
                            <p id="displayTotalPrice">$<?php echo $product_details['price']; ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="mobile">Mobile Number:</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address:</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                        </div>
                </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary" name="confirm_order">Confirm Order</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('quantity').addEventListener('input', function() {
        let quantity = this.value;
        let price = <?php echo $product_details['price']; ?>;

        let totalPrice = quantity * price;
        document.getElementById('displayTotalPrice').textContent = '$' + totalPrice.toFixed(2);

        document.getElementById('modalQuantity').value = quantity;
        });

        document.getElementById('size').addEventListener('change', function () {
        let selectedSize = this.value;
        document.getElementById('modalSize').value = selectedSize;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>