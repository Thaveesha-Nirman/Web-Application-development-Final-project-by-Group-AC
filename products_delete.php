<?php
require '../includes/db.php';
require '../includes/functions.php';

require_role(['admin', 'superadmin']);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("Product ID is required.");
}

$stmt = $mysqli->prepare("SELECT image, image2 FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

$stmt = $mysqli->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $uploadDir = "../uploads/";

    if (!empty($product['image']) && file_exists($uploadDir . $product['image'])) {
        unlink($uploadDir . $product['image']);
    }

    if (!empty($product['image2']) && file_exists($uploadDir . $product['image2'])) {
        unlink($uploadDir . $product['image2']);
    }

    header("Location: products_list.php?msg=Product+deleted+successfully");
    exit;
} else {
    die("Error deleting product: " . $mysqli->error);
}
?>
