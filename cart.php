<?php
session_start();
require 'includes/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['update_qty'])){
    foreach($_POST['qty'] as $cart_id => $quantity){
        $quantity = intval($quantity);
        if($quantity > 0){
            $stmt = $mysqli->prepare("UPDATE cart SET quantity=? WHERE id=? AND user_id=?");
            $stmt->bind_param("iii", $quantity, $cart_id, $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$stmt = $mysqli->prepare("SELECT cart.id as cart_id, products.name, products.price, products.image, cart.quantity 
                          FROM cart 
                          JOIN products ON cart.product_id = products.id 
                          WHERE cart.user_id=?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - SP Mobiles</title>
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
        
        /* Reset list styles */
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

            .cart-table {
                font-size: 0.9rem !important;
            }
            
            .cart-table th,
            .cart-table td {
                padding: 10px 8px !important;
            }
            
            .cart-table img {
                width: 60px !important;
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

            .cart-table {
                display: block !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
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
                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">🛒 Cart (Active)</a>
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
        <h1 style="font-size: 2.5rem; color: #f3961c; font-family: 'Miniver', cursive; margin-bottom: 10px;">Your Cart</h1>
        <p style="color: #fff; font-size: 1.12rem; font-weight: 500;">Manage your selected items</p>
    </div>

    <?php if(!empty($cart_items)): ?>
    <form method="POST">
        <table class="cart-table" style="width: 100%; border-collapse: collapse; margin: 20px 0; background: rgba(255, 255, 255, 0.1); border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); overflow: hidden;">
            <thead>
                <tr style="background: rgba(59, 20, 28, 0.7);">
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Image</th>
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Product</th>
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Price</th>
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Quantity</th>
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Subtotal</th>
                    <th style="padding: 15px; text-align: center; color: #f3961c; font-weight: 600; font-size: 1.12rem;">Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $total = 0;
            foreach($cart_items as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); transition: background 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; text-align: center;">
                        <img src="uploads/<?= htmlspecialchars($item['image']) ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>"
                             style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid rgba(243, 150, 28, 0.3);">
                    </td>
                    <td style="padding: 15px; text-align: center; color: #f3961c; font-weight: 500; font-size: 1.05rem;"><?= htmlspecialchars($item['name']) ?></td>
                    <td style="padding: 15px; text-align: center; color: #fff; font-weight: 500;">LKR <?= number_format($item['price'],2) ?></td>
                    <td style="padding: 15px; text-align: center;">
                        <input type="number" 
                               name="qty[<?= $item['cart_id'] ?>]" 
                               value="<?= $item['quantity'] ?>" 
                               min="1" 
                               style="width: 70px; text-align: center; padding: 8px; border-radius: 8px; border: 1px solid #f3961c; background: rgba(255, 255, 255, 0.9); font-weight: 600;">
                    </td>
                    <td style="padding: 15px; text-align: center; color: #ffffffff; font-weight: 700; font-size: 1.15rem;">LKR <?= number_format($subtotal,2) ?></td>
                    <td style="padding: 15px; text-align: center;">
                        <a href="remove_from_cart.php?cart_id=<?= $item['cart_id'] ?>" 
                           onclick="return confirm('Remove this item from cart?');"
                           style="display: inline-block; padding: 8px 16px; background: #3b141c; color: #f3961c; border-radius: 20px; font-weight: 600; text-decoration: none; transition: 0.3s; font-size: 0.9rem;"
                           onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                           onmouseout="this.style.background='#3b141c'; this.style.color='#f3961c';">🗑️ Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <div style="text-align: center; margin: 30px 0;">
            <button type="submit" 
                    name="update_qty"
                    style="padding: 12px 30px; background: #f3961c; color: #3b141c; border-radius: 30px; font-weight: 600; border: none; cursor: pointer; font-size: 1.1rem; transition: 0.3s;"
                    onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                    onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">🔄 Update Quantities</button>
        </div>
    </form>
    
    <div style="text-align: right; margin-top: 30px; padding: 25px; background: rgba(255, 255, 255, 0.1); border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(243, 150, 28, 0.3);">
        <h2 style="color: #ffffffff; font-size: 1.8rem; font-weight: 700; font-family: 'Miniver', cursive;">Total: LKR <?= number_format($total,2) ?></h2>
        <div style="margin-top: 20px;">
            <a href="galary.php" 
               style="display: inline-block; padding: 12px 25px; background: transparent; color: #fff; border: 2px solid #fff; border-radius: 30px; font-weight: 600; text-decoration: none; transition: 0.3s; margin-right: 15px;"
               onmouseover="this.style.background='#fff'; this.style.color='#3b141c';"
               onmouseout="this.style.background='transparent'; this.style.color='#fff';">← Continue Shopping</a>
            
            <a href="checkout.php" 
               style="display: inline-block; padding: 12px 25px; background: #f3961c; color: #3b141c; border-radius: 30px; font-weight: 600; text-decoration: none; transition: 0.3s;"
               onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
               onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">Proceed to Checkout →</a>
        </div>
    </div>

    <?php else: ?>
        <div style="text-align: center; padding: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); margin: 50px 0;">
            <div style="font-size: 4rem; margin-bottom: 20px;">🛒</div>
            <h3 style="color: #f3961c; font-size: 1.5rem; margin-bottom: 15px; font-family: 'Miniver', cursive;">Your cart is empty</h3>
            <p style="color: #fff; font-size: 1.1rem; margin-bottom: 30px;">Looks like you haven't added any items to your cart yet.</p>
            <a href="galary.php" 
               style="display: inline-block; padding: 15px 40px; background: #f3961c; color: #3b141c; border-radius: 30px; font-weight: 600; text-decoration: none; transition: 0.3s; font-size: 1.1rem;"
               onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
               onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">🛍️ Start Shopping</a>
        </div>
    <?php endif; ?>

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

</body>
</html>