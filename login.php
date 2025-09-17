<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $mysqli->prepare("SELECT id, username, role, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SP Mobiles</title>
    <link rel="stylesheet" href="login.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sticky-footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="login-container">
            <div class="login-box">
                <h2>Login</h2>
                <?php if($error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>
                <p class="register-text">Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
    
    <footer class="sticky-footer" style="background:#3b141c; color:#fff; padding:15px 0; width:100%;">
        <div style="max-width:100%; margin:0; padding:0 15px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; max-width:1200px; margin:0 auto;">
                
                <div style="flex:0 0 auto;">
                    <h3 style="font-family:'Miniver',cursive; color:#f3961c; font-size:1.4rem; margin:0;">SP Mobiles</h3>
                    <p style="font-size:0.85rem; color:#ccc; margin:2px 0 0 0;">
                        Your trusted mobile partner
                    </p>
                </div>

                <div style="flex:1; display:flex; justify-content:center; gap:25px; flex-wrap:wrap;">
                    <a href="index.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:color 0.3s ease;" 
                       onmouseover="this.style.color='#f3961c';" 
                       onmouseout="this.style.color='#fff';">Home</a>
                    <a href="about.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:color 0.3s ease;" 
                       onmouseover="this.style.color='#f3961c';" 
                       onmouseout="this.style.color='#fff';">About</a>
                    <a href="galary.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:color 0.3s ease;" 
                       onmouseover="this.style.color='#f3961c';" 
                       onmouseout="this.style.color='#fff';">Gallery</a>
                    <a href="contact-us.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:color 0.3s ease;" 
                       onmouseover="this.style.color='#f3961c';" 
                       onmouseout="this.style.color='#fff';">Contact</a>
                </div>

                <div style="flex:0 0 auto; text-align:right;">
                    <p style="font-size:0.8rem; color:#ccc; margin:0; white-space:nowrap;">&copy; <?php echo date('Y'); ?> SP Mobiles</p>
                </div>
            </div>
        </div>
        
        <style>
            @media (max-width: 768px) {
                .sticky-footer > div > div {
                    flex-direction: column !important;
                    text-align: center !important;
                    gap: 10px !important;
                }
                
                .sticky-footer > div > div > div {
                    text-align: center !important;
                }
                
                .sticky-footer > div > div > div:nth-child(2) {
                    gap: 20px !important;
                    margin: 5px 0 !important;
                }
                
                .sticky-footer > div > div > div:nth-child(3) p {
                    white-space: normal !important;
                }
            }
        </style>
    </footer>
</body>
</html>