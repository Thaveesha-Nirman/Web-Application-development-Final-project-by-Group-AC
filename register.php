<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {

        $stmt = $mysqli->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "Email already registered.";
        } else {
        
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'customer'; // default role
            $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $mysqli->insert_id;
                $_SESSION['user_name'] = $username;
                $_SESSION['user_role'] = $role;
                header("Location: index.php");
                exit;
            } else {
                $error = "Registration failed: " . $mysqli->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - SP Mobiles</title>
    <link rel="stylesheet" href="login-register.css">
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
        <div class="auth-container">
            <div class="auth-box">
                <h1>Create Account</h1>

                <?php if (!empty($error)): ?>
                    <div class="error-msg" style="color:red;"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form class="myForm" method="POST">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter username" required value="<?= htmlspecialchars($username ?? '') ?>">

                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" required value="<?= htmlspecialchars($email ?? '') ?>">

                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>

                    <button type="submit">Register</button>
                </form>

                <p class="switch-auth">Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>

    <script>
    document.querySelector('.myForm').addEventListener('submit', function(e){
        const password = document.getElementById('password').value;
        if(password.length < 8){
            alert('Password must be at least 8 characters long');
            e.preventDefault(); 
        }
    });
    </script>

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