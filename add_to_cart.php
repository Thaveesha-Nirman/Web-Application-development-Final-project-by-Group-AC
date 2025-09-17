<?php
session_start();
require 'includes/db.php';

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])){
    $user_id = $_SESSION['user_id'];
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    $stmt = $mysqli->prepare("SELECT id, quantity FROM cart WHERE user_id=? AND product_id=?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;
        $stmt = $mysqli->prepare("UPDATE cart SET quantity=? WHERE id=?");
        $stmt->bind_param("ii", $new_quantity, $row['id']);
        $stmt->execute();
    } else {
        $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
    }
    
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
        exit;
    } else {
        header('Location: galary.php');
        exit;
    }
}
?>