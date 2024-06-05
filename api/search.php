<?php
header('Content-Type: application/json');

$cars = json_decode(file_get_contents('../data/cars.json'), true);

// Assign unique IDs to each car if not already present
foreach ($cars as $index => &$car) {
    if (!isset($car['id'])) {
        $car['id'] = $index + 1;
    }
}

if (isset($_GET['keyword'])) {
    $keyword = strtolower($_GET['keyword']);
    $result = array_filter($cars, function($car) use ($keyword) {
        return strpos(strtolower($car['model']), $keyword) !== false ||
               strpos(strtolower($car['brand']), $keyword) !== false ||
               strpos(strtolower($car['type']), $keyword) !== false;
    });
} elseif (isset($_GET['category'])) {
    $category = strtolower($_GET['category']);
    $result = array_filter($cars, function($car) use ($category) {
        return strtolower($car['type']) === $category;
    });
} else {
    $result = $cars;
}

echo json_encode(array_values($result));
?>
