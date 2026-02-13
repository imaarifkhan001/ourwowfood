<?php
session_start();
header('Content-Type: application/json');
include "db_config.php";

if (!isset($_SESSION['user_id'])) {
  echo json_encode(["success" => false, "message" => "Please login first."]);
  exit;
}

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$cart = $data['cart'] ?? [];

if (!is_array($cart) || count($cart) === 0) {
  echo json_encode(["success" => false, "message" => "Cart is empty."]);
  exit;
}

$user_id = (int)$_SESSION['user_id'];

$total = 0;
foreach ($cart as $item) {
  $price = (float)($item['price'] ?? 0);
  $qty   = (int)($item['quantity'] ?? 1);
  $total += ($price * $qty);
}

mysqli_query($conn, "INSERT INTO orders (user_id, total_amount) VALUES ($user_id, $total)");
$order_id = mysqli_insert_id($conn);

foreach ($cart as $item) {
  $name = mysqli_real_escape_string($conn, (string)($item['name'] ?? 'Item'));
  $price = (float)($item['price'] ?? 0);
  $qty   = (int)($item['quantity'] ?? 1);

  mysqli_query($conn, "INSERT INTO order_items (order_id, item_name, price, quantity)
                       VALUES ($order_id, '$name', $price, $qty)");
}

echo json_encode([
  "success" => true,
  "message" => "✅ Order Placed!",
  "order_id" => $order_id
]);
