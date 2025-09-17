<?php
require '../includes/db.php';
require '../includes/functions.php';

require_role(['admin','superadmin']); 

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? 'customer';

    if ($username && $email && $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $mysqli->error;
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New User</title>
<link rel="stylesheet" href="admin-product.css">
</head>
<body>
<div class="admin-dashboard">
    <h1>Add New User</h1>

    <div class="dashboard-actions">
        <a href="index.php" class="btn back-home">← Back to Dashboard</a>
    </div>

    <?php if(!empty($error)) echo "<div class='error-msg'>$error</div>"; ?>

    <form class="admin-form" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Role:</label>
        <select name="role">
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
            <option value="superadmin">Superadmin</option>
        </select>

        <button type="submit" class="btn">Add User</button>
    </form>
</div>
</body>
</html>
