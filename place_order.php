<?php
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['user_id'])) {
  echo json_encode(["ok"=>false, "msg"=>"Please login first"]);
  exit;
}

include "db_config.php";

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if(!$data || !isset($data["items"]) || count($data["items"]) === 0){
  echo json_encode(["ok"=>false, "msg"=>"Cart empty"]);
  exit;
}

$user_id = (int)$_SESSION['user_id'];
$total = (float)$data["total"];

mysqli_begin_transaction($conn);

try {
  // Insert order
  $stmt = mysqli_prepare($conn, "INSERT INTO orders (user_id, total) VALUES (?, ?)");
  mysqli_stmt_bind_param($stmt, "id", $user_id, $total);
  mysqli_stmt_execute($stmt);
  $order_id = mysqli_insert_id($conn);

  // Insert items
  $stmt2 = mysqli_prepare($conn, "INSERT INTO order_items (order_id, item_name, price, qty) VALUES (?, ?, ?, ?)");
  foreach($data["items"] as $it){
    $name = $it["name"];
    $price = (float)$it["price"];
    $qty = (int)$it["quantity"];
    mysqli_stmt_bind_param($stmt2, "isdi", $order_id, $name, $price, $qty);
    mysqli_stmt_execute($stmt2);
  }

  mysqli_commit($conn);

  echo json_encode(["ok"=>true, "msg"=>"Order placed", "order_id"=>$order_id]);
} catch(Exception $e){
  mysqli_rollback($conn);
  echo json_encode(["ok"=>false, "msg"=>"DB error"]);
}
