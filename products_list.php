<?php
require '../includes/db.php';
session_start();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $mysqli->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: products_list.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products List - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Roboto:wght@400;500;600;700&display=swap');
  </style>
</head>
<body style="margin:0; font-family:'Roboto',sans-serif; background:linear-gradient(76deg,rgba(59,20,28,1)69%,rgba(243,150,28,1)62%); color:#fff;">

<header style="background:transparent; padding:20px 0;">
  <nav style="max-width:1300px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; padding:0 20px;">
    <a href="../index.php" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
      <img src="../images/WhatsApp_Image_2025-07-31_at_21.45.54_a2b8b8e3-removebg-preview.png" alt="SP Logo" style="width:90px;height:90px;">
      <h2 style="color:#fff;font-size:1.8rem;font-weight:600;">SP Mobiles - Admin</h2>
    </a>
    <div style="display:flex;gap:15px;flex-wrap:wrap;">
      <a href="../index.php" style="padding:10px 18px; color:#fff; border-radius:30px; font-size:1rem; text-decoration:none; transition:0.3s;" 
         onmouseover="this.style.background='#f3961c';this.style.color='#3b141c';" 
         onmouseout="this.style.background='transparent';this.style.color='#fff';">Home</a>
      <a href="product_create.php" style="padding:10px 18px; background:#f3961c; color:#3b141c; border-radius:30px; font-size:1rem; text-decoration:none; font-weight:600; transition:0.3s;" 
         onmouseover="this.style.background='#3b141c';this.style.color='#f3961c';" 
         onmouseout="this.style.background='#f3961c';this.style.color='#3b141c';">+ Add Product</a>
    </div>
  </nav>
</header>

<main style="max-width:1300px; margin:40px auto; padding:0 20px;">
  <div style="text-align:center; margin-bottom:30px;">
    <h1 style="font-family:'Miniver',cursive;font-size:2.5rem;color:#f3961c;margin-bottom:10px;">Products List</h1>
    <p style="font-size:1.1rem;color:#fff;">Manage your products here</p>
  </div>

  <div style="overflow-x:auto;">
  <table style="width:100%; border-collapse:collapse; background:rgba(255,255,255,0.1); border-radius:15px; backdrop-filter:blur(10px); overflow:hidden;">
    <thead>
      <tr style="background:rgba(59,20,28,0.7);">
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">ID</th>
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">Name</th>
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">Description</th>
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">Price</th>
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">Image</th>
        <th style="padding:15px; text-align:center; color:#f3961c; font-size:1.1rem;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr style="border-bottom:1px solid rgba(255,255,255,0.1);transition:background 0.3s;" 
            onmouseover="this.style.background='rgba(255,255,255,0.05)';" 
            onmouseout="this.style.background='transparent';">
          <td style="padding:15px; text-align:center; color:#fff;"><?= $row['id'] ?></td>
          <td style="padding:15px; text-align:center; color:#f3961c; font-weight:500;"><?= htmlspecialchars($row['name']) ?></td>
          <td style="padding:15px; text-align:center; color:#fff;"><?= htmlspecialchars($row['description']) ?></td>
          <td style="padding:15px; text-align:center; color:#fff;">LKR <?= number_format($row['price'],2) ?></td>
          <td style="padding:15px; text-align:center;">
            <?php if($row['image']): ?>
              <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:2px solid rgba(243,150,28,0.3);">
            <?php else: ?>
              <span style="color:#fff;">No Image</span>
            <?php endif; ?>
          </td>
          <td style="padding:15px; text-align:center;">
            <a href="product_edit.php?id=<?= $row['id'] ?>" style="display:inline-block; padding:8px 16px; background:#f3961c; color:#3b141c; border-radius:20px; text-decoration:none; font-weight:600; font-size:0.9rem; transition:0.3s;" 
               onmouseover="this.style.background='#3b141c';this.style.color='#f3961c';" 
               onmouseout="this.style.background='#f3961c';this.style.color='#3b141c';">✏️ Edit</a>
            <a href="products_list.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this product?');" style="display:inline-block; padding:8px 16px; background:#3b141c; color:#f3961c; border-radius:20px; text-decoration:none; font-weight:600; font-size:0.9rem; transition:0.3s; margin-left:10px;" 
               onmouseover="this.style.background='#f3961c';this.style.color='#3b141c';" 
               onmouseout="this.style.background='#3b141c';this.style.color='#f3961c';">🗑️ Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  </div>
</main>

</body>
</html>
