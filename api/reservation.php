<?php
session_start();
include('../db/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carId = $_POST['carId'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $license = $_POST['license'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $quantity = $_POST['quantity']; // Added quantity
    $price = $_POST['price'];

    // Calculate total cost
    $startDateObj = new DateTime($startDate);
    $endDateObj = new DateTime($endDate);
    $interval = $startDateObj->diff($endDateObj);
    $days = $interval->days;
    $totalCost = $quantity * $price * $days;

    try {
        $stmt = $pdo->prepare("INSERT INTO reservations (car_id, name, mobile, email, license, start_date, end_date, quantity, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$carId, $name, $mobile, $email, $license, $startDate, $endDate, $quantity, $totalCost]);

        $_SESSION['reservation'] = [
            'carId' => $carId,
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'license' => $license,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'quantity' => $quantity,
            'total_cost' => $totalCost
        ];

        header('Location: ../confirm.php');
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
