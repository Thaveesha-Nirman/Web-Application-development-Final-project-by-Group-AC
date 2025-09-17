<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'superadmin'])) {
    header('Location: ../login.php');
    exit;
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? 0;
    $category_id = (int)($_POST['category_id'] ?? 0);

    $stmt = $mysqli->prepare("SELECT id FROM categories WHERE id=?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $catResult = $stmt->get_result();
    if ($catResult->num_rows === 0) {
        $error = "Selected category does not exist.";
    }

    $image1 = '';
    $image2 = '';

    if (!$error) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        if (!empty($_FILES['image1']['name'])) {
            $image1 = time() . '_1_' . basename($_FILES['image1']['name']);
            $target_file1 = $target_dir . $image1;
            if (!move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1)) $error = "Failed to upload first image.";
        } else $error = "First image is required.";

        if (!$error && !empty($_FILES['image2']['name'])) {
            $image2 = time() . '_2_' . basename($_FILES['image2']['name']);
            $target_file2 = $target_dir . $image2;
            if (!move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2)) $error = "Failed to upload second image.";
        }
    }

    if (!$error) {
        $stmt = $mysqli->prepare("INSERT INTO products (name, description, price, category_id, image, image2) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiss", $name, $description, $price, $category_id, $image1, $image2);
        if ($stmt->execute()) $success = "Product added successfully!";
        else $error = "Database error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Product - Admin</title>
<link rel="stylesheet" href="admin-product.css">
</head>
<body>
<div class="auth-container">
    <div class="auth-box">
        <h1>Add New Product</h1>

        <?php if ($success): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Product Name</label>
            <input type="text" name="name" placeholder="Enter product name" required>

            <label>Description</label>
            <textarea name="description" placeholder="Enter description" required></textarea>

            <label>Price</label>
            <input type="number" step="0.01" name="price" placeholder="Enter price" required>

            <label>Category</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                <?php
                $catResult = $mysqli->query("SELECT id, name FROM categories");
                while ($cat = $catResult->fetch_assoc()) {
                    echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                }
                ?>
            </select>

            <label>Image 1</label>
            <input type="file" name="image1" accept="image/*" required>

            <label>Image 2</label>
            <input type="file" name="image2" accept="image/*">

            <button type="submit">Add Product</button>
        </form>
        <a href="../index.php" class="back-home">← Back to Homepage</a>
    </div>
</div>
</body>
</html>
