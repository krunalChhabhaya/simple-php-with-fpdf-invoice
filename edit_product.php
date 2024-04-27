<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('./db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    $sql = "SELECT * FROM product WHERE product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row['product_name'];
        $description = $row['description'];
        $price = $row['price'];
        $quantity = $row['quantity'];
    } else {
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_GET['product_id'];
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $updateQuery = "UPDATE product SET product_name='$productName', description='$description', price=$price, quantity=$quantity WHERE product_id=$productId";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Sen:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h1 class="company-name">FootFlex</h1>
                <div class="admin-details">
                    <img src="./imgs/icons8-user-50.png" alt="Admin Image" class="admin-image">
                    <span>Admin Username</span>
                </div>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">Add Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_order.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 p-3">
                <h2 class="text-center">Update Product</h2>
                <form class="p-5 bg-secondary rounded-5" method="POST">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $productName; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description"><?php echo $description; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?php echo $price; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?>">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>