<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
session_start();
include('./db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
  $deleteId = $_POST['delete_id'];

  $deleteSizeRelationQuery = "DELETE FROM size_has_product WHERE product_product_id = $deleteId";

  if ($conn->query($deleteSizeRelationQuery) === TRUE) {
    $deleteProductQuery = "DELETE FROM product WHERE product_id = $deleteId";

    if ($conn->query($deleteProductQuery) === TRUE) {
      header("Location: dashboard.php");
      exit();
    } else {
      echo "Error deleting product record: " . $conn->error;
    }
  } else {
    echo "Error deleting related records: " . $conn->error;
  }
}

$sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.quantity, GROUP_CONCAT(s.size SEPARATOR ', ') as sizes
        FROM product p
        LEFT JOIN size_has_product sp ON p.product_id = sp.product_product_id
        LEFT JOIN size s ON sp.size_size_id = s.size_id
        GROUP BY p.product_id";

$result = $conn->query($sql);
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

      <div class="col-md-9">
        <div class="main-content">
          <h2>Product List</h2>
          <a href="list_pdf.php" class="btn btn-primary" target="_blank">Print Product List</a>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Quantity</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['sizes'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>";
                    echo '<a href="edit_product.php?product_id=' . $row['product_id'] . '" class="btn btn-primary">';
                    echo '<img src="./imgs/edit.png" alt="Edit" width="20" height="20">';
                    echo '</a>';

                    echo '<form method="POST">';
                    echo '<input type="hidden" name="delete_id" value="' . $row['product_id'] . '">';
                    echo '<button type="submit" class="btn btn-danger">';
                    echo '<img src="./imgs/delete.png" alt="Delete" width="20" height="20">';
                    echo '</button>';
                    echo '</form>';

                    echo "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='6'>No products found</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
$conn->close();
?>