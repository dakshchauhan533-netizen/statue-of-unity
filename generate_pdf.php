<?php
require('fpdf/fpdf.php'); // Include the FPDF library

// Database connection
$con = mysqli_connect("localhost", "root", "", "website");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get ticket_id from URL
if (!isset($_GET['ticket_id'])) {
    die("Invalid ticket ID");
}
$ticket_id = intval($_GET['ticket_id']); // Sanitize input

// Fetch ticket details from the database
$sql = "SELECT * FROM `ticket_book` WHERE id = '$ticket_id'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) == 0) {
    die("No ticket found with the given ID");
}
$ticket = mysqli_fetch_assoc($result);

// Initialize the PDF with custom size
$pdf = new FPDF('P', 'mm', array(110, 130)); // Height: 100mm, Width: 170mm
$pdf->AddPage();

// Header section
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'STATUE OF UNITY TICKET', 0, 1, 'C'); // Title at top
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 8, 'Ek Bharat, Shreshtha Bharat', 0, 1, 'C'); // Tagline
$pdf->Ln(7); // Add spacing

// Ticket details section
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Place Name:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, $ticket['place_name'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Email:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, $ticket['email'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Phone:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, $ticket['phone'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Adults:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, $ticket['adult'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Children:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, $ticket['child'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Date:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, date('M j, Y', strtotime($ticket['date'])), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, 'Total Price:', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(34, 139, 34); // Green text for total price
$pdf->Cell(0, 8, number_format($ticket['total_price']) . ' INR', 0, 1);
$pdf->SetTextColor(0, 0, 0); // Reset text color

$pdf->Ln(5); // Add spacing

// Footer section
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Thank you for visiting the Statue of Unity!', 0, 1, 'C');

// Output the PDF
$pdf->Output();
?>
