<?php
session_start();
include "db_config.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}

$user_id = (int)$_SESSION['user_id'];

$orders = mysqli_query($conn, "SELECT id, user_id, total_amount, created_at 
                               FROM orders 
                               WHERE user_id=$user_id 
                               ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>My Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-black">My Orders</h1>
      <a href="index.php" class="px-4 py-2 bg-black text-white rounded-lg">Back</a>
    </div>

    <?php if(mysqli_num_rows($orders)==0): ?>
      <div class="bg-white p-6 rounded-xl shadow">No orders yet.</div>
    <?php else: ?>
      <?php while($o = mysqli_fetch_assoc($orders)): ?>
        <div class="bg-white p-5 rounded-xl shadow mb-4">
          <div class="flex justify-between">
            <div>
              <div class="font-bold">Order #<?php echo (int)$o['id']; ?></div>
              <div class="text-sm text-gray-500"><?php echo htmlspecialchars($o['created_at']); ?></div>
            </div>
            <div class="font-black text-red-600">
              ₹<?php echo number_format((float)$o['total_amount'], 2); ?>
            </div>
          </div>

          <div class="mt-3 border-t pt-3">
            <?php
              $oid = (int)$o['id'];
              $items = mysqli_query($conn, "SELECT item_name, price, quantity 
                                            FROM order_items 
                                            WHERE order_id=$oid");
              while($it = mysqli_fetch_assoc($items)):
            ?>
              <div class="flex justify-between text-sm py-1">
                <div>
                  <?php echo htmlspecialchars($it['item_name']); ?>
                  (x<?php echo (int)$it['quantity']; ?>)
                </div>
                <div>₹<?php echo number_format((float)$it['price'], 2); ?></div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</body>
</html>
