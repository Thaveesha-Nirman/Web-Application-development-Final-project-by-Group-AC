<?php
require '../includes/db.php';
require '../includes/functions.php';

require_role(['admin','superadmin']);

$users = $mysqli->query("SELECT id, username, email, role FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="admin-product.css">
<style>
    .admin-dashboard h1 {
        font-family: "Miniver", cursive;
        font-size: 2.5rem;
        color: #ffffff;
        text-align: center;
        margin-bottom: 20px;
    }
    .dashboard-actions a.btn {
        display: inline-block;
        padding: 10px 20px;
        margin-right: 10px;
        background: #f3961c;
        color: #3b141c;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .dashboard-actions a.btn:hover {
        background: #3b141c;
        color: #f3961c;
    }
</style>
</head>
<body>
<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>

    <div class="dashboard-actions">
        <a href="users_create.php" class="btn">+ Add New User</a>
        <a href="orders.php" class="btn">📦 View Orders</a> <!-- 👈 New Orders Button -->
        <a href="../logout.php" class="btn logout">Logout</a>
    </div>

    <h2 style="color:white;"> Users / Admins</h2>
    <br>
    <div class="users-grid">
        <?php while($user = $users->fetch_assoc()): ?>
            <div class="user-card">
                <h3><?= htmlspecialchars($user['username']) ?></h3>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
                <div class="card-actions">
                    <a href="users_edit.php?id=<?= $user['id'] ?>" class="btn edit">Edit</a>
                    <a href="users_delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?');" class="btn delete">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
     <a href="../index.php" class="btn back-home">← Homepage</a>
</div>
</body>
</html>
