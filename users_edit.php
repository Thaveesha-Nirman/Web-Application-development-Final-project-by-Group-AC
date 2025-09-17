<?php
require '../includes/db.php';
require '../includes/functions.php';
require_role(['admin','superadmin']); 
if (!isset($_GET['id'])) {
    die("No user ID specified.");
}
$id = (int)$_GET['id'];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
if (!$user) {
    die("User not found.");
}

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'customer';

    if (!$username || !$email) {
        $error = "Username and Email are required.";
    } else {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $user['password'];
        }

        $stmt = $mysqli->prepare("UPDATE users SET username=?, email=?, password=?, role=? WHERE id=?");
        $stmt->bind_param("ssssi", $username, $email, $hashed_password, $role, $id);

        if ($stmt->execute()) {
            $success = "User updated successfully!";
            $stmt = $mysqli->prepare("SELECT * FROM users WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
        } else {
            $error = "Error: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link rel="stylesheet" href="admin-product.css">
</head>
<body>
<div class="admin-dashboard">
    <h1>Edit User</h1>

    <div class="dashboard-actions">
        <a href="index.php" class="btn back-home">← Back to Dashboard</a>
    </div>

    <?php if($success) echo "<div class='success-msg'>$success</div>"; ?>
    <?php if($error) echo "<div class='error-msg'>$error</div>"; ?>

    <form class="admin-form" method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>New Password (leave blank to keep current):</label>
        <input type="password" name="password">

        <label>Role:</label>
        <select name="role">
            <option value="customer" <?= $user['role']=='customer'?'selected':'' ?>>Customer</option>
            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            <option value="superadmin" <?= $user['role']=='superadmin'?'selected':'' ?>>Superadmin</option>
        </select>

        <button type="submit" class="btn">Update User</button>
    </form>
</div>
</body>
</html>
