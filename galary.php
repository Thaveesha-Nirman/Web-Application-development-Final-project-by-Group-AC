<?php
require 'includes/db.php';
session_start();

$result = $mysqli->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Phone Gallery - SP Mobiles</title>
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
        }

        ul, li {
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #3b141c;
            color:  rgba(243, 150, 28, 0.95);
            padding: 15px 25px;
            border-radius: 30px;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
            border: 2px solid #f3961c;
            box-shadow: 0 8px 25px rgba(243, 150, 28, 0.3);
        }

        .success-notification.show {
            transform: translateX(0);
        }

        .success-notification.hide {
            transform: translateX(400px);
            opacity: 0;
        }

        .add-cart-btn {
            position: relative;
            overflow: hidden;
        }

        .add-cart-btn.loading {
            color: transparent !important;
            pointer-events: none;
        }

        .add-cart-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid #3b141c;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .add-cart-btn.success {
            background: #4CAF50 !important;
            color: #fff !important;
        }

        .add-cart-btn.success::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            font-weight: bold;
            color: #fff;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .phone-card {
            position: relative;
        }

        .phone-card.cart-added {
            animation: cartAddedPulse 0.6s ease;
        }

        @keyframes cartAddedPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); box-shadow: 0 0 20px rgba(243, 150, 28, 0.6); }
            100% { transform: scale(1); }
        }

        .cart-icon-animate {
            position: fixed;
            pointer-events: none;
            z-index: 999;
            color: #f3961c;
            font-size: 24px;
            animation: flyToCart 1s ease-out forwards;
        }

        @keyframes flyToCart {
            0% {
                opacity: 1;
                transform: scale(1);
            }
            70% {
                opacity: 0.8;
                transform: scale(0.8);
            }
            100% {
                opacity: 0;
                transform: scale(0.3);
            }
        }

        @media (max-width: 1024px) {
            .phone-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 768px) {
            .phone-grid {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }
            
            .gallery-title h1 {
                font-size: 2rem !important;
            }
            
            .navbar {
                flex-direction: column !important;
                gap: 15px !important;
            }
            
            .nav-menu {
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 5px !important;
            }
            
            .nav-menu a {
                padding: 8px 12px !important;
                font-size: 0.9rem !important;
            }
            
            .logo-text {
                font-size: 1.5rem !important;
                margin-left: 0 !important;
            }
            
            .logo-photo {
                width: 60px !important;
                height: 60px !important;
            }
            
            .gallery-title {
                margin-top: 50px !important;
                margin-bottom: 50px !important;
            }

            .success-notification {
                top: 10px;
                right: 10px;
                left: 10px;
                transform: translateY(-100px);
            }

            .success-notification.show {
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .nav-menu a {
                padding: 6px 10px !important;
                font-size: 0.8rem !important;
            }
            
            .phone-card {
                margin-bottom: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div id="successNotification" class="success-notification">
        🛒 Added to cart successfully!
    </div>

    <header>
        <nav style="padding: 20px; display: flex; align-items: center; justify-content: space-between; max-width: 1300px; margin: 0 auto;" class="navbar">
            <img src="uploads/WhatsApp_Image_2025-07-31_at_21.45.54_a2b8b8e3-removebg-preview.png" 
                 alt="" 
                 style="width: 80px; height: 80px;" class="logo-photo">
            
            <a href="index.php" style="text-decoration: none;">
                <h2 style="color: #fff; font-size: 2rem; font-weight: 600; position: relative; text-align: left;" class="logo-text">SP Mobiles</h2>
            </a>
            <div style="background: rgba(255, 255, 255, 0.1); margin-left: 250px; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 25px; padding: 8px 15px; backdrop-filter: blur(10px);" class="user-info">
                <span style="color: #f3961c; font-size: 0.9rem; font-weight: 600;">👋</span>
                <span style="color: #fff; font-size: 0.9rem; font-weight: 500; margin-left: 5px;">Hello!</span>
            </div>
            <ul style="display: flex; gap: 10px; list-style: none; margin: 0; padding: 0;" class="nav-menu">
                <li><a href="index.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.color='#f3961c'; this.style.background='#3b141c';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Home</a></li>
                
                <li><a href="about.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.color='#f3961c'; this.style.background='#3b141c';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">About</a></li>

                <li><a href="galary.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.color='#f3961c'; this.style.background='#3b141c';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Gallery</a></li>
                
                <li><a href="cart.php" id="cartLink"
                       style="padding: 8px 15px; background: rgba(243, 150, 28, 0.2); color: #fff; border: 1px solid #f3961c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.color='#f3961c'; this.style.background='#3b141c';"
                       onmouseout="this.style.background='rgba(243, 150, 28, 0.2)'; this.style.color='#fff';">🛒 Cart</a></li>
                
                <li><a href="contact-us.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.color='#f3961c'; this.style.background='#3b141c';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <div>
                <div style="text-align: center; margin-top: 100px; margin-bottom: 100px;" class="gallery-title">
                    <h1 style="font-size: 2.3rem; color: #f3961c; font-family: Arial, Helvetica, sans-serif; margin-bottom: 10px;">Gallery</h1>
                    <p style="color: #fff; font-size: 1.12rem; font-weight: 500;">Discover our amazing collection of premium smartphones</p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-top: 40px;" class="phone-grid">
                    <?php if(!empty($products)): ?>
                        <?php foreach($products as $product): ?>
                            
                            <div style="background: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 20px; text-align: center; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom: 50px;" 
                                 class="phone-card" data-product-id="<?= $product['id'] ?>"
                                 onmouseover="this.style.transform='translateY(-30px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.3)';"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                
                                <div style="position: relative; height: 200px; overflow: hidden; margin-bottom: 20px;" class="card-carousel">
                                    <?php if($product['image']): ?>
                                        <img src="uploads/<?= htmlspecialchars($product['image']) ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                             style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 150px; height: 170px; opacity: 0; transition: opacity 0.5s ease-in-out;"
                                             class="card-carousel-image" />
                                    <?php endif; ?>
                                    <?php if($product['image2']): ?>
                                        <img src="uploads/<?= htmlspecialchars($product['image2']) ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                             style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 150px; height: 170px; opacity: 0; transition: opacity 0.5s ease-in-out;"
                                             class="card-carousel-image" />
                                    <?php endif; ?>
                                    <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); width: 80px; height: 8px; background: rgba(0,0,0,0.3); border-radius: 50%; filter: blur(3px);"></div>
                                </div>
                                
                                <div style="color: #fff;">
                                    <h3 style="font-size: 1.12rem; font-weight: 600; margin-bottom: 10px; color: #f3961c;"><?= htmlspecialchars($product['name']) ?></h3>
                                    <p style="font-size: 1.5rem; font-weight: 700; color: #fff; margin-bottom: 5px;">LKR <?= number_format($product['price'], 2) ?></p>
                                    <p style="font-size: 0.9rem; color: #ccc; line-height: 1.4;"><?= htmlspecialchars($product['description']) ?></p>
                                </div>
                                
                                <?php if(isset($_SESSION['user_id'])): ?>
                                    <form class="add-to-cart-form" data-product-id="<?= $product['id'] ?>" style="margin-top:15px;">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 10px; flex-wrap: wrap;">
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="1" 
                                                   min="1" 
                                                   style="width:60px; padding: 8px; border-radius: 8px; border: 1px solid #ccc; text-align: center;">
                                            <button type="submit" 
                                                    class="add-cart-btn"
                                                    style="background:#f3961c; color:#3b141c; padding:10px 20px; border-radius:30px; font-weight:600; border:none; cursor:pointer; transition: 0.3s;"
                                                    onmouseover="if(!this.classList.contains('loading') && !this.classList.contains('success')) { this.style.background='#3b141c'; this.style.color='#f3961c'; }"
                                                    onmouseout="if(!this.classList.contains('loading') && !this.classList.contains('success')) { this.style.background='#f3961c'; this.style.color='#3b141c'; }">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <div style="margin-top: 15px;">
                                        <a href="login.php" 
                                           style="display:inline-block; background:#f3961c; color:#3b141c; padding:10px 20px; border-radius:30px; font-weight:600; text-decoration:none; transition: 0.3s;"
                                           onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">
                                           Login to Add
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['admin','superadmin'])): ?>
                                    <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                                        <a href="admin/products_edit.php?id=<?= $product['id'] ?>" 
                                           style="display:inline-block; padding:8px 16px; border-radius:30px; font-weight:600; text-decoration:none; background:#f3961c; color:#3b141c; transition:0.3s;"
                                           onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';"
                                        >Edit</a>
                                        <a href="admin/products_delete.php?id=<?= $product['id'] ?>" 
                                           onclick="return confirm('Are you sure?');"
                                           style="display:inline-block; padding:8px 16px; border-radius:30px; font-weight:600; text-decoration:none; background:#3b141c; color:#f3961c; transition:0.3s;"
                                           onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                                           onmouseout="this.style.background='#3b141c'; this.style.color='#f3961c';"
                                        >Delete</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #fff; text-align: center; grid-column: 1/-1;">No products found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('.card-carousel').forEach(carousel=>{
            const images = carousel.querySelectorAll('.card-carousel-image');
            if(images.length > 0) {
                let index=0;
                images[0].style.opacity='1'; 
                
                if(images.length > 1) {
                    setInterval(()=>{
                        images.forEach(img=>img.style.opacity='0');
                        index = (index+1)%images.length;
                        images[index].style.opacity='1';
                    }, 3000);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.add-to-cart-form');
            const notification = document.getElementById('successNotification');
            const cartLink = document.getElementById('cartLink');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const button = form.querySelector('.add-cart-btn');
                    const card = form.closest('.phone-card');
                    const formData = new FormData(form);
                    
                    button.classList.add('loading');
                    button.disabled = true;
                    
                    createFlyingCartIcon(button);
                    
                    fetch('add_to_cart.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        button.classList.remove('loading');
                        
                        button.classList.add('success');
                        button.innerHTML = 'Added!';
                        
                        card.classList.add('cart-added');
                        
                        showSuccessNotification();
                        
                        animateCartLink();
                        
                        setTimeout(() => {
                            button.classList.remove('success');
                            button.innerHTML = 'Add to Cart';
                            button.disabled = false;
                            card.classList.remove('cart-added');
                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        button.classList.remove('loading');
                        button.disabled = false;
                    });
                });
            });

            function createFlyingCartIcon(button) {
                const icon = document.createElement('div');
                icon.innerHTML = '🛒';
                icon.className = 'cart-icon-animate';
                
                const buttonRect = button.getBoundingClientRect();
                const cartRect = cartLink.getBoundingClientRect();
                
                icon.style.left = buttonRect.left + buttonRect.width / 2 + 'px';
                icon.style.top = buttonRect.top + buttonRect.height / 2 + 'px';
                
                document.body.appendChild(icon);
                
                setTimeout(() => {
                    icon.style.left = cartRect.left + cartRect.width / 2 + 'px';
                    icon.style.top = cartRect.top + cartRect.height / 2 + 'px';
                }, 10);
                
                setTimeout(() => {
                    document.body.removeChild(icon);
                }, 1000);
            }

            function showSuccessNotification() {
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.add('hide');
                    setTimeout(() => {
                        notification.classList.remove('show', 'hide');
                    }, 400);
                }, 3000);
            }

            function animateCartLink() {
                cartLink.style.transform = 'scale(1.1)';
                cartLink.style.background = '#f3961c';
                cartLink.style.color = '#3b141c';
                
                setTimeout(() => {
                    cartLink.style.transform = 'scale(1)';
                    cartLink.style.background = 'rgba(243, 150, 28, 0.2)';
                    cartLink.style.color = '#fff';
                }, 500);
            }
        });
    </script>

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