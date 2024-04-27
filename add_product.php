<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
include('./db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $sizes = $_POST['sizes'] ?? [];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["productImg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["productImg"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["productImg"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $targetFile)) {

            $insertQuery = "INSERT INTO product(product_img, product_name, description, price, quantity) VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($insertQuery);
            if ($stmt) {
                $stmt->bind_param("ssssi", $targetFile, $product_name, $description, $price, $quantity);
        
                if ($stmt->execute()) {
                    $productId = mysqli_insert_id($conn);
        
                    if (!empty($sizes)) {
                        foreach ($sizes as $sizeId) {
                            $insertSizeQuery = "INSERT INTO size_has_product (size_size_id, product_product_id) VALUES (?, ?)";
                            $stmtSize = $conn->prepare($insertSizeQuery);
                            if ($stmtSize) {
                                $stmtSize->bind_param("ii", $sizeId, $productId);
                                $stmtSize->execute();
                                $stmtSize->close();
                            } else {
                                echo "Size insertion failed: " . $conn->error;
                            }
                        }
                    }
        
                    header("location: add_product.php?success=true"); 
                    exit();
                } else {
                    echo "Error: " . $conn->error; 
                }
                $stmt->close();
            } else {
                echo "Prepare statement error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Sen:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 sidebar">
      <h1 class="company-name">FootFlex</h1>
      <div class="admin-details">
        <img src="./imgs/icons8-user-50.png" alt="Admin Image" class="admin-image">
        <span>Admin</span>
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
    <h2 class="text-center">Add Product</h2>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
        <div class="alert alert-success" role="alert">
            Product added successfully!
        </div>
    <?php } ?>
    <form class="p-5 bg-secondary rounded-5" method="POST" action="add_product.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Enter description"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Enter price">
            </div>
            <div class="col-md-6 mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity">
            </div>
        </div>
        <div class="mb-3">
            <label for="sizes" class="form-label">Select Sizes:</label><br>
            <div class="d-flex flex-wrap">
                <?php
                $sql = "SELECT * FROM size";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<label class="me-3 mb-2">';
                        echo '<input type="checkbox" name="sizes[]" value="' . $row['size_id'] . '"> ' . $row['size'];
                        echo '</label>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="productImg" class="form-label">Product Image</label>
            <input type="file" class="form-control" name="productImg" id="productImg">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>