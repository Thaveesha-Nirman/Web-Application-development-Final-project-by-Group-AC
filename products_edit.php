<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin','superadmin'])) {
    die("Access denied. You do not have permission to edit products.");
}

if (!isset($_GET['id'])) die("No product ID specified.");
$id = (int)$_GET['id'];

$stmt = $mysqli->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
if (!$product) die("Product not found.");

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? 0;
    $stock       = $_POST['stock'] ?? 0;
    $category_id = (int)($_POST['category_id'] ?? 0);

    $image1 = $product['image'];
    $image2 = $product['image2'];

    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    if (!empty($_FILES['image1']['name'])) {
        $image1_name = time() . '_1_' . basename($_FILES['image1']['name']);
        $target_file1 = $target_dir . $image1_name;
        if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_file1)) {
            if (!empty($product['image']) && file_exists($target_dir . $product['image'])) unlink($target_dir . $product['image']);
            $image1 = $image1_name;
        } else $error = "Failed to upload first image.";
    }

    if (!empty($_FILES['image2']['name'])) {
        $image2_name = time() . '_2_' . basename($_FILES['image2']['name']);
        $target_file2 = $target_dir . $image2_name;
        if (move_uploaded_file($_FILES['image2']['tmp_name'], $target_file2)) {
            if (!empty($product['image2']) && file_exists($target_dir . $product['image2'])) unlink($target_dir . $product['image2']);
            $image2 = $image2_name;
        } else $error = "Failed to upload second image.";
    }

    if (!$error) {
        $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, category_id=?, image=?, image2=? WHERE id=?");
        $stmt->bind_param("ssdisssi", $name, $description, $price, $stock, $category_id, $image1, $image2, $id);
        if ($stmt->execute()) {
            $success = "Product updated successfully!";
            $stmt = $mysqli->prepare("SELECT * FROM products WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $product = $stmt->get_result()->fetch_assoc();
        } else $error = "Error updating product: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product - Admin</title>
<link rel="stylesheet" href="admin-product.css">
</head>
<body>
<div class="auth-container">
    <div class="auth-box">
        <h1>Edit Product</h1>

        <?php if($success): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <label>Product Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

            <label>Description</label>
            <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

            <label>Stock</label>
            <input type="number" name="stock" value="<?= htmlspecialchars($product['stock']) ?>">

            <label>Category</label>
            <select name="category_id" required>
                <?php
                $catResult = $mysqli->query("SELECT id, name FROM categories");
                while ($cat = $catResult->fetch_assoc()) {
                    $selected = ($product['category_id'] == $cat['id']) ? 'selected' : '';
                    echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                }
                ?>
            </select>

            <label>Current Image 1</label>
            <?php if($product['image']): ?>
                <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" width="120">
            <?php endif; ?>
            <input type="file" name="image1">

            <label>Current Image 2</label>
            <?php if($product['image2']): ?>
                <img src="../uploads/<?= htmlspecialchars($product['image2']) ?>" width="120">
            <?php endif; ?>
            <input type="file" name="image2">

            <button type="submit">Update Product</button>
        </form>
        <a href="../index.php" class="back-home">← Back to Homepage</a>
    </div>
</div>
</body>
</html>
