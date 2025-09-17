<?php
session_start();
require 'includes/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if(isset($_GET['cart_id'])){
    $cart_id = intval($_GET['cart_id']);

    $stmt = $mysqli->prepare("DELETE FROM cart WHERE id=? AND user_id=?");
    $stmt->bind_param("ii", $cart_id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
}

header("Location: cart.php");
exit;
?>
