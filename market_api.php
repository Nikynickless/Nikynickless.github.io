<?php
require 'config.php';

header('Content-Type: application/json');

// Fetch products from the database
$query = $conn->prepare("SELECT * FROM marketplace_products WHERE is_active = 1 ORDER BY created_at DESC");
$query->execute();
$result = $query->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'price' => $row['price'],
        'image' => $row['image'], // Ensure images are stored or linked correctly
        'seller_id' => $row['seller_id'],
    ];
}

echo json_encode([
    'status' => 'success',
    'products' => $products,
]);
?>