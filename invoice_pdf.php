<?php
include('./db_connect.php');
require('./fpdf184/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(0, 10, 'INVOICE', 0, 1, 'C'); 

$pdf->SetFont('Arial', '', 12);

$companyName = "FootFlex";
$companyAddress = "299 Doon Valley Dr,";
$companyCity = "Kitchener,";
$companyPostalCode = "ON N2G 4M4";
$companyContact = "+1 (519) 781 - 7326";

$pdf->SetXY(20, 30); 
$pdf->Cell(0, 10, $companyName, 0, 1,'B'); 
$pdf->Cell(0, 10, $companyAddress, 0, 1); 
$pdf->Cell(0, 10, $companyCity, 0, 1); 
$pdf->Cell(0, 10, $companyPostalCode, 0, 1); 
$pdf->Cell(0, 10, $companyContact, 0, 1); 

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $customer_query = "SELECT u.username, o.user_address, o.user_email, o.user_mobile
                       FROM `order` o
                       INNER JOIN `user` u ON o.user_user_id = u.user_id
                       WHERE o.order_id = $order_id";

    $customer_result = mysqli_query($conn, $customer_query);
    
        if ($customer_result && $customer = mysqli_fetch_assoc($customer_result)) {
            $pdf->SetXY(120, 30); 
            $pdf->Cell(0, 10, 'Billed To:', 0, 1, 'B'); 
            $pdf->SetXY(120, 40);
            $pdf->Cell(0, 10, 'Name: ' . $customer['username'], 0, 1); 
            $pdf->SetXY(120, 50);
            $pdf->Cell(0, 10, 'Address: ' . $customer['user_address'], 0, 1); 
            $pdf->SetXY(120, 60);
            $pdf->Cell(0, 10, 'Email: ' . $customer['user_email'], 0, 1); 
            $pdf->SetXY(120, 70);
            $pdf->Cell(0, 10, 'Mobile: ' . $customer['user_mobile'], 0, 1);
    } else {
        $pdf->SetXY(100, 30); 
        $pdf->Cell(0, 10, 'Customer info not found', 0, 1); 
    }
} else {
    $pdf->SetXY(100, 30); 
    $pdf->Cell(0, 10, 'Order ID not provided', 0, 1); 
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

$product_query = "SELECT p.product_name, p.price, o.ord_quantity, (p.price * o.ord_quantity) AS total_price 
FROM product p
INNER JOIN order_has_product op ON p.product_id = op.product_product_id
INNER JOIN `order` o ON op.order_order_id = o.order_id
WHERE op.order_order_id = $order_id";

    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $pdf->SetXY(20, 100); 

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Product Name', 1);
        $pdf->Cell(30, 10, 'Price', 1);
        $pdf->Cell(30, 10, 'Quantity', 1);
        $pdf->Cell(40, 10, 'Total Price', 1);
        $pdf->Ln(); 

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(20, 110);
        while ($product = mysqli_fetch_assoc($product_result)) {
            $pdf->Cell(60, 10, $product['product_name'], 1);
            $pdf->Cell(30, 10, $product['price'], 1);
            $pdf->Cell(30, 10, $product['ord_quantity'], 1);
            $pdf->Cell(40, 10, $product['total_price'], 1);
            $pdf->Ln(); 
        }
    } else {
        $pdf->SetXY(20, 100);
        $pdf->Cell(0, 10, 'No products found for this order', 0, 1);
    }
}

$pdf->SetXY(20, 130); 
$pdf->SetFont('Arial', 'B', 12); 

$pdf->Cell(0, 10, 'Terms & Conditions', 0, 1, 'L'); 

$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(20, 130);
$pdf->Cell(0, 20, 'At FootFlex, we stand behind the quality of our products. We offer a hassle-free return or replacement policy within', 0, 1, 'L'); 
$pdf->SetXY(20, 135);
$pdf->Cell(0, 20, '14 days of the purchase date. Items returned must be in their original condition, unworn, and with all tags attached.', 0, 1, 'L'); 
$pdf->SetXY(20, 140);
$pdf->Cell(0, 20, 'condition, unworn, and with all tags attached.', 0, 1, 'L'); 
$pdf->Output();
?>
