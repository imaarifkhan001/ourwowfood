<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
include "db_config.php";
$user_id = (int)$_SESSION['user_id'];

$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="max-w-3xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-black">My Orders</h1>
      <a href="index.php" class="px-4 py-2 bg-black text-white rounded-lg">Back</a>
    </div>

    <?php while($o = mysqli_fetch_assoc($orders)) { ?>
      <div class="bg-white p-5 rounded-2xl shadow mb-4">
        <div class="flex justify-between">
          <div>
            <p class="font-bold">Order #<?php echo $o['id']; ?></p>
            <p class="text-xs text-gray-500"><?php echo $o['created_at']; ?></p>
          </div>
          <p class="font-black text-red-600">₹<?php echo $o['total']; ?></p>
        </div>

        <div class="mt-3 border-t pt-3">
          <?php
            $oid = (int)$o['id'];
            $items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id=$oid");
            while($it = mysqli_fetch_assoc($items)){
          ?>
            <div class="flex justify-between text-sm py-1">
              <span><?php echo htmlspecialchars($it['item_name']); ?> (x<?php echo $it['qty']; ?>)</span>
              <span>₹<?php echo $it['price']; ?></span>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>

    <?php if(mysqli_num_rows($orders) == 0) { ?>
      <div class="text-center text-gray-500 mt-20">No orders yet.</div>
    <?php } ?>
  </div>
</body>
</html>
