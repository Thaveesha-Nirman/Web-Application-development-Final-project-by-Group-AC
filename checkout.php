<?php
session_start();
require 'includes/db.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$stmt = $mysqli->prepare("SELECT c.*, p.name AS product_name, p.price 
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_result = $stmt->get_result();

$cart_items = [];
$total_amount = 0;

while ($row = $cart_result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_amount += $row['price'] * $row['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['customer_name']);
    $email = trim($_POST['customer_email']);
    $phone = trim($_POST['customer_phone']);
    $address = trim($_POST['customer_address']);
    $payment_method = 'COD';

    $order_stmt = $mysqli->prepare("INSERT INTO orders 
        (user_id, customer_name, customer_email, customer_phone, customer_address, total_amount, payment_method) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $order_stmt->bind_param("issssds",
        $user_id,
        $name,
        $email,
        $phone,
        $address,
        $total_amount,
        $payment_method
    );
    $order_stmt->execute();
    $order_id = $order_stmt->insert_id;

    $item_stmt = $mysqli->prepare("INSERT INTO order_items 
        (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($cart_items as $item) {
        $item_stmt->bind_param("iiid", 
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['price']
        );
        $item_stmt->execute();
    }

    $del_stmt = $mysqli->prepare("DELETE FROM cart WHERE user_id = ?");
    $del_stmt->bind_param("i", $user_id);
    $del_stmt->execute();

    header("Location: thank_you.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SP Mobiles</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }
        
        body {
            background: linear-gradient(76deg, rgba(59, 20, 28, 1) 69%, rgba(243, 150, 28, 1) 62%);
            min-height: 100vh;
            background-attachment: fixed;
            background-size: cover;
            color: #fff;
        }
        
        ul, li {
            list-style: none;
        }
        
        a {
            text-decoration: none;
        }

        .section-content {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column !important;
                gap: 15px !important;
            }
            
            .nav-content {
                flex-direction: column !important;
                gap: 15px !important;
            }
            
            .nav-menu {
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 8px !important;
            }
            
            .nav-menu a {
                padding: 8px 12px !important;
                font-size: 0.9rem !important;
            }
            
            .user-section {
                flex-direction: column !important;
                gap: 10px !important;
                text-align: center !important;
            }
            
            .nav-logo img {
                width: 80px !important;
                height: 80px !important;
            }
            
            .nav-logo h2 {
                font-size: 1.5rem !important;
            }

            .checkout-table {
                font-size: 0.9rem !important;
            }
            
            .checkout-table th,
            .checkout-table td {
                padding: 10px 8px !important;
            }

            .form-container {
                padding: 20px 15px !important;
            }
        }

        @media (max-width: 480px) {
            .nav-menu a {
                padding: 6px 10px !important;
                font-size: 0.8rem !important;
            }
            
            .user-info {
                font-size: 0.8rem !important;
                padding: 6px 12px !important;
            }

            .checkout-table {
                display: block !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
            }

            .form-grid {
                grid-template-columns: 1fr !important;
                gap: 15px !important;
            }
        }
    </style>
</head>
<body>

<header>
    <nav style="display: flex; justify-content: space-between; align-items: center; padding: 20px; flex-wrap: wrap; max-width: 1300px; margin: 0 auto;" class="navbar">
        <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;" class="nav-logo">
            <img src="uploads/WhatsApp_Image_2025-07-31_at_21.45.54_a2b8b8e3-removebg-preview.png" 
                 alt="SP Logo"
                 style="width: 130px; height: 130px;">
            <h2 style="color: #fff; font-size: 2rem; font-weight: 600;">SP Mobiles</h2>
        </a>

        <div style="display: flex; align-items: center; gap: 30px; flex-wrap: wrap;" class="nav-content">
            <ul style="display: flex; gap: 10px; flex-wrap: wrap; list-style: none;" class="nav-menu">
                <li><a href="index.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">Home</a></li>
                
                <li><a href="about.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">About</a></li>
                
                <li><a href="galary.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">Gallery</a></li>
                
                <li><a href="contact-us.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">Contact</a></li>
            </ul>

            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;" class="user-section">
                <?php if(isset($_SESSION['user_name'])): ?>
                    <div style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 25px; padding: 8px 15px; backdrop-filter: blur(10px);" class="user-info">
                        <span style="color: #f3961c; font-size: 0.9rem; font-weight: 600;">👋</span>
                        <span style="color: #fff; font-size: 0.9rem; font-weight: 500; margin-left: 5px;">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                    </div>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="cart.php" 
                           style="padding: 8px 15px; background: #f3961c; color: #3b141c; border: 1px solid #f3961c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                           onmouseover="this.style.background='rgba(243, 150, 28, 0.8)'; this.style.color='#3b141c';"
                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">🛒 Cart</a>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['admin','superadmin'])): ?>
                    <a href="admin/index.php" 
                       style="padding: 8px 15px; background: #3b141c; color: #f3961c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='#3b141c'; this.style.color='#f3961c';">⚙️ Admin</a>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" 
                       style="padding: 8px 15px; background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 20px; font-size: 0.9rem; font-weight: 500; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='rgba(255, 255, 255, 0.2); this.style.borderColor='#fff';"
                       onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(255, 255, 255, 0.3)';">Logout</a>
                <?php else: ?>
                    <a href="login.php" 
                       style="padding: 8px 15px; background: #f3961c; color: #3b141c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">Login</a>
                    
                    <a href="register.php" 
                       style="padding: 8px 15px; background: transparent; color: #fff; border: 1px solid #fff; border-radius: 20px; font-size: 0.9rem; font-weight: 500; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#fff'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<main class="section-content">
    <div style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
        <h1 style="font-size: 2.5rem; color: #f3961c; font-family: 'Miniver', cursive; margin-bottom: 10px;">Checkout</h1>
        <p style="color: #fff; font-size: 1.12rem; font-weight: 500;">Complete your purchase</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 50px;" class="checkout-grid">
        <div style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 30px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <h2 style="color: #f3961c; font-size: 1.5rem; font-family: 'Miniver', cursive; margin-bottom: 20px; text-align: center;">📦 Your Order</h2>
            
            <table class="checkout-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr style="background: rgba(59, 20, 28, 0.5); border-radius: 8px;">
                        <th style="padding: 15px; color: #f3961c; font-weight: 600; text-align: left; border-bottom: 2px solid rgba(243, 150, 28, 0.3);">Product</th>
                        <th style="padding: 15px; color: #f3961c; font-weight: 600; text-align: center; border-bottom: 2px solid rgba(243, 150, 28, 0.3);">Price</th>
                        <th style="padding: 15px; color: #f3961c; font-weight: 600; text-align: center; border-bottom: 2px solid rgba(243, 150, 28, 0.3);">Qty</th>
                        <th style="padding: 15px; color: #f3961c; font-weight: 600; text-align: center; border-bottom: 2px solid rgba(243, 150, 28, 0.3);">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); transition: background 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 12px 15px; color: #fff; font-weight: 500;"><?= htmlspecialchars($item['product_name']) ?></td>
                        <td style="padding: 12px 15px; color: #fff; text-align: center;">LKR <?= number_format($item['price'],2) ?></td>
                        <td style="padding: 12px 15px; color: #fff; text-align: center; font-weight: 600;"><?= $item['quantity'] ?></td>
                        <td style="padding: 12px 15px; color: #f3961c; text-align: center; font-weight: 700;">LKR <?= number_format($item['price']*$item['quantity'],2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background: rgba(243, 150, 28, 0.1); border-top: 2px solid #f3961c;">
                        <td colspan="3" style="padding: 15px; color: #fff; font-weight: 700; font-size: 1.1rem;">Grand Total</td>
                        <td style="padding: 15px; color: #f3961c; text-align: center; font-weight: 700; font-size: 1.3rem;">LKR <?= number_format($total_amount,2) ?></td>
                    </tr>
                </tfoot>
            </table>

            <div style="background: rgba(243, 150, 28, 0.1); border-radius: 10px; padding: 15px; border: 1px solid rgba(243, 150, 28, 0.3);">
                <p style="color: #f3961c; font-weight: 600; text-align: center; font-size: 1.1rem;">💳 Payment Method: Cash on Delivery</p>
            </div>
        </div>

        <div class="form-container" style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 30px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
            <h2 style="color: #f3961c; font-size: 1.5rem; font-family: 'Miniver', cursive; margin-bottom: 20px; text-align: center;">📋 Delivery Information</h2>
            
            <form method="POST">
                <div class="form-grid" style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                    <div>
                        <label for="customer_name" style="display: block; color: #f3961c; font-weight: 600; margin-bottom: 8px; font-size: 1.05rem;">👤 Full Name</label>
                        <input type="text" 
                               id="customer_name" 
                               name="customer_name" 
                               required
                               style="width: 100%; padding: 12px 15px; border: 2px solid rgba(243, 150, 28, 0.3); border-radius: 10px; background: rgba(255, 255, 255, 0.9); font-size: 1rem; transition: 0.3s ease;"
                               onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 1)';"
                               onblur="this.style.borderColor='rgba(243, 150, 28, 0.3)'; this.style.background='rgba(255, 255, 255, 0.9)';">
                    </div>

                    <div>
                        <label for="customer_email" style="display: block; color: #f3961c; font-weight: 600; margin-bottom: 8px; font-size: 1.05rem;">📧 Email Address</label>
                        <input type="email" 
                               id="customer_email" 
                               name="customer_email" 
                               required
                               style="width: 100%; padding: 12px 15px; border: 2px solid rgba(243, 150, 28, 0.3); border-radius: 10px; background: rgba(255, 255, 255, 0.9); font-size: 1rem; transition: 0.3s ease;"
                               onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 1)';"
                               onblur="this.style.borderColor='rgba(243, 150, 28, 0.3)'; this.style.background='rgba(255, 255, 255, 0.9)';">
                    </div>

                    <div>
                        <label for="customer_phone" style="display: block; color: #f3961c; font-weight: 600; margin-bottom: 8px; font-size: 1.05rem;">📱 Phone Number</label>
                        <input type="text" 
                               id="customer_phone" 
                               name="customer_phone" 
                               required
                               style="width: 100%; padding: 12px 15px; border: 2px solid rgba(243, 150, 28, 0.3); border-radius: 10px; background: rgba(255, 255, 255, 0.9); font-size: 1rem; transition: 0.3s ease;"
                               onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 1)';"
                               onblur="this.style.borderColor='rgba(243, 150, 28, 0.3)'; this.style.background='rgba(255, 255, 255, 0.9)';">
                    </div>

                    <div>
                        <label for="customer_address" style="display: block; color: #f3961c; font-weight: 600; margin-bottom: 8px; font-size: 1.05rem;">🏠 Delivery Address</label>
                        <textarea id="customer_address" 
                                  name="customer_address" 
                                  rows="4" 
                                  required
                                  style="width: 100%; padding: 12px 15px; border: 2px solid rgba(243, 150, 28, 0.3); border-radius: 10px; background: rgba(255, 255, 255, 0.9); font-size: 1rem; resize: vertical; transition: 0.3s ease;"
                                  onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 1)';"
                                  onblur="this.style.borderColor='rgba(243, 150, 28, 0.3)'; this.style.background='rgba(255, 255, 255, 0.9)';"></textarea>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" 
                            style="padding: 15px 40px; background: #f3961c; color: #3b141c; border: none; border-radius: 30px; font-size: 1.2rem; font-weight: 700; cursor: pointer; transition: 0.3s ease; font-family: 'Roboto', sans-serif;"
                            onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.transform='translateY(0px)';">
                        🎯 Confirm Order
                    </button>
                </div>
            </form>

            <div style="text-align: center; margin-top: 20px;">
                <a href="cart.php" 
                   style="display: inline-block; padding: 10px 25px; background: transparent; color: #fff; border: 2px solid rgba(255, 255, 255, 0.3); border-radius: 25px; font-weight: 500; text-decoration: none; transition: 0.3s; font-size: 1rem;"
                   onmouseover="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='#fff';"
                   onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255, 255, 255, 0.3)';">
                    ← Back to Cart
                </a>
            </div>
        </div>
    </div>
</main>

<footer style="background:#3b141c; color:#fff; padding:40px 20px; margin-top:50px;">
  <div style="max-width:1300px; margin:0 auto; display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:20px;">
    
    <div>
      <h3 style="font-family:'Miniver',cursive; color:#f3961c; font-size:1.8rem; margin-bottom:8px;">SP Mobiles</h3>
      <p style="font-size:0.95rem; line-height:1.5; color:#ccc;">
        Your trusted partner for mobile phones & accessories.
      </p>
    </div>

    <div style="display:flex; gap:15px; flex-wrap:wrap;">
      <a href="index.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:0.3s;" 
         onmouseover="this.style.color='#f3961c';" 
         onmouseout="this.style.color='#fff';">Home</a>
      <a href="about.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:0.3s;" 
         onmouseover="this.style.color='#f3961c';" 
         onmouseout="this.style.color='#fff';">About</a>
      <a href="galary.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:0.3s;" 
         onmouseover="this.style.color='#f3961c';" 
         onmouseout="this.style.color='#fff';">Gallery</a>
      <a href="contact-us.php" style="color:#fff; font-size:0.9rem; text-decoration:none; transition:0.3s;" 
         onmouseover="this.style.color='#f3961c';" 
         onmouseout="this.style.color='#fff';">Contact</a>
    </div>

    <div>
      <p style="font-size:0.85rem; color:#ccc;">&copy; <?php echo date('Y'); ?> SP Mobiles. All rights reserved.</p>
    </div>
  </div>
</footer>

<style>
@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }
}
</style>

</body>
</html>