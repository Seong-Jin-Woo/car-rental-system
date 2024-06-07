<?php
session_start();

if (!isset($_SESSION['reservation'])) {
    header('Location: index.php');
    exit();
}

$reservation = $_SESSION['reservation'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Order Confirmation</h1>
    </header>
    <main>
        <h2>Thank you for your reservation, <?php echo htmlspecialchars($reservation['name']); ?>!</h2>
        <p>Here are your reservation details:</p>
        <ul>
            <li>Car ID: <?php echo htmlspecialchars($reservation['carId']); ?></li>
            <li>Start Date: <?php echo htmlspecialchars($reservation['start_date']); ?></li>
            <li>End Date: <?php echo htmlspecialchars($reservation['end_date']); ?></li>
            <li>Quantity: <?php echo htmlspecialchars($reservation['quantity']); ?></li>
            <li>Total Cost: $<?php echo htmlspecialchars($reservation['total_cost']); ?></li>
        </ul>
        <p>We have sent a confirmation email to <?php echo htmlspecialchars($reservation['email']); ?>.</p>
        <p><a href="confirm_order.php">Click here to confirm your order</a>.</p>
    </main>
    <footer>
        <p>&copy; 2024 Car Rental System</p>
    </footer>
</body>
</html>
