<?php
include('./db_connect.php');
require('./fpdf184/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 19);

$pdf->Cell(0, 10, 'FootFlex', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, '299 Doon Valley Dr, Kitchener, ON N2G 4M4', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);

$sql = "SELECT p.product_id, p.product_name, p.description, p.price, p.quantity, GROUP_CONCAT(s.size SEPARATOR ', ') as sizes
        FROM product p
        LEFT JOIN size_has_product sp ON p.product_id = sp.product_product_id
        LEFT JOIN size s ON sp.size_size_id = s.size_id
        GROUP BY p.product_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Product ID: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 7, $row['product_id'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Product Name: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 7, $row['product_name'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Description: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 7, $row['description'], 0, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Price: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 7, '$' . $row['price'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Quantity: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 7, $row['quantity'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 7, 'Sizes: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 7, $row['sizes'], 0, 1, 'L');

        $pdf->Cell(0, 0, '', 'T'); 
        $pdf->Ln(3);
    }
} else {
    $pdf->Cell(0, 10, 'No products found', 0, 1);
}

$pdf->Output();
?>
