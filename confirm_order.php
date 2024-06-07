<?php
session_start();
include('db/config.php');

if (!isset($_SESSION['reservation'])) {
    header('Location: index.php');
    exit();
}

$reservation = $_SESSION['reservation'];

try {
    $stmt = $pdo->prepare("UPDATE orders SET status = 'confirmed' WHERE car_id = ? AND user_email = ? AND rent_start_date = ? AND rent_end_date = ?");
    $stmt->execute([$reservation['carId'], $reservation['email'], $reservation['start_date'], $reservation['end_date']]);

    // Optionally, update car availability in your cars table or JSON file

    unset($_SESSION['reservation']);

    echo "Your order has been confirmed. Thank you!";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
