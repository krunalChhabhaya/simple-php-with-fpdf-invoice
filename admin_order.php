<!-- Group Members:
Krunal Chhabhaya – 8890229
Priyanshu Kumar Bhardwaj – 8828610
Faizansayeed Mohammed – 8878625
Sahil Sharma – 8903063 -->

<?php
session_start();

include('db_connect.php');
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
      <div class="col-md-9 main-content">
        <h2>Customer's Orders</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $order_query = "SELECT o.order_id, p.product_name, p.price, o.ord_size, o.ord_quantity, o.total_price, u.username, o.user_address, o.user_email
                                FROM `order` o
                                INNER JOIN user u ON o.user_user_id = u.user_id
                                INNER JOIN order_has_product op ON o.order_id = op.order_order_id
                                INNER JOIN product p ON op.product_product_id = p.product_id";

                $result = mysqli_query($conn, $order_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['product_name']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['ord_size']}</td>";
                        echo "<td>{$row['ord_quantity']}</td>";
                        echo "<td>{$row['total_price']}</td>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['user_address']}</td>";
                        echo "<td>{$row['user_email']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
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