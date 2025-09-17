<?php
require '../includes/db.php';
require '../includes/functions.php';
require_role(['admin','superadmin']); 

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if(!$id) die("User ID required");

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
    die("You cannot delete yourself.");
}

$stmt = $mysqli->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);

if($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    die("Error deleting user: " . $mysqli->error);
}
?>
