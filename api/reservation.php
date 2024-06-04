<?php
session_start();
include('car-rental-system/db/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carId = $_POST['carId'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $license = $_POST['license'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_email, rent_start_date, rent_end_date, car_id, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$email, $startDate, $endDate, $carId, $price]);

    $_SESSION['reservation'] = [
        'carId' => $carId,
        'name' => $name,
        'mobile' => $mobile,
        'email' => $email,
        'license' => $license,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'price' => $price
    ];

    header('Location: car-rental-system/confirm.php');
}
?>
