<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';

$result = $mysqli->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home - SP Mobiles</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: "Roboto", sans-serif; 
        }

        body {
            background: linear-gradient(76deg, rgba(59,20,28,1) 69%, rgba(243,150,28,1) 62%);
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
            
            .hero-content {
                flex-direction: column !important;
                text-align: center !important;
            }
            
            .hero-details h2 {
                font-size: 2rem !important;
            }
            
            .hero-details h3 {
                font-size: 1.5rem !important;
            }
            
            .products-gallery {
                grid-template-columns: 1fr !important;
            }
            
            .carousel {
                height: 180px !important;
            }
            
            .hero-carousel {
                max-width: 300px !important;
                height: 300px !important;
            }
            
            .hero-carousel img {
                width: 180px !important;
                height: 300px !important;
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
            
            .buttons {
                flex-direction: column !important;
                align-items: center !important;
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
                      style="padding: 8px 15px; background: #f3961c; color: #ffffffff; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#ffffffff';">Gallery</a></li>
                
                <li><a href="contact-us.php" 
                       style="padding: 8px 15px; background: #f3961c; color: #ffffffff; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#ffffffff';">Contact</a></li>
            </ul>

            <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;" class="user-section">
                <?php if(isset($_SESSION['user_name'])): ?>
                    <div style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 25px; padding: 8px 15px; backdrop-filter: blur(10px);" class="user-info">
                        <span style="color: #f3961c; font-size: 0.9rem; font-weight: 600;">👋</span>
                        <span style="color: #fff; font-size: 0.9rem; font-weight: 500; margin-left: 5px;">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                    </div>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="cart.php" 
                           style="padding: 8px 15px; background: rgba(243, 150, 28, 0.2); color: #ffffffff; border: 1px solid #f3961c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"                           onmouseout="this.style.background='rgba(243, 150, 28, 0.2)'; this.style.color='#ffffffff';">🛒 Cart</a>
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
                       style="padding: 8px 15px; background: #f3961c; color: #ffffffff; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#ffffffff';">Logout</a>
                <?php else: ?>
                    <a href="login.php" 
                       style="padding: 8px 15px; background: #f3961c; color: #ffffffff; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#ffffffff';">Login</a>
                    
                    <a href="register.php" 
                       style="padding: 8px 15px; background: transparent; color: #fff; border: 1px solid #fff; border-radius: 20px; font-size: 0.9rem; font-weight: 500; transition: 0.3s; text-decoration: none;"
                       onmouseover="this.style.background='#fff'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<main>
    <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 0 20px;" class="hero-section">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 40px; width: 100%; max-width: 1300px; color: #fff; flex-wrap: wrap;" class="hero-content">
            <div style="flex: 1; min-width: 250px;" class="hero-details">
                <h2 style="font-family: 'Miniver', cursive; font-size: 2.5rem; color: #f3961c;">Best In the Market</h2>
                <h3 style="margin-top: 8px; font-size: 2rem; font-weight: 600;">Make your mobile dream true with our special service!</h3>
                <p style="margin: 24px 0 40px; font-size: 1.12rem; line-height: 1.5;">Welcome to SP MOBILES, where technology meets reliability and customer satisfaction</p>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;" class="buttons">
                    <a href="galary.php" 
                       style="padding: 12px 30px; background: #f3961c; color: #3b141c; border-radius: 30px; border: 2px solid transparent; text-decoration: none; font-weight: 600; transition: 0.3s;"
                       onmouseover="this.style.background='transparent'; this.style.color='#fff'; this.style.borderColor='#fff';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.borderColor='transparent';">📱 Phone Gallery</a>
                    
                    <a href="contact-us.php" 
                       style="padding: 12px 30px; background: transparent; color: #fff; border: 2px solid #fff; border-radius: 30px; text-decoration: none; font-weight: 600; transition: 0.3s;"
                       onmouseover="this.style.background='#fff'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='transparent'; this.style.color='#fff';">📞 Contact Us</a>
                </div>
            </div>
            
            <div style="flex: 1; min-width: 250px; max-width: 500px; height: 400px; position: relative; display: flex; justify-content: center; align-items: end;" class="hero-carousel">
                <img src="uploads/phone.png" 
                     style="width: 220px; height: 350px; object-fit: contain; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); opacity: 1; transition: opacity 1s ease-in-out; z-index: 2;" 
                     class="active" alt="Phone 1">
                <img src="uploads/phone3.png" 
                     style="width: 220px; height: 350px; object-fit: contain; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); opacity: 0; transition: opacity 1s ease-in-out; z-index: 1;" 
                     alt="Phone 2">
                <img src="uploads/phone2.png" 
                     style="width: 220px; height: 350px; object-fit: contain; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); opacity: 0; transition: opacity 1s ease-in-out; z-index: 1;" 
                     alt="Phone 3">
                <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 160px; height: 22px; background: rgba(0,0,0,0.4); border-radius: 50%; filter: blur(6px); z-index: 0;"></div>
            </div>
        </div>
    </section>

    <?php if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['admin','superadmin'])): ?>
    <section style="padding: 50px 20px; max-width: 1300px; margin: 0 auto;" class="products-section">
        <h2 style="text-align: center; color: #fff; font-size: 2.5rem; margin-bottom: 40px;">Our Products</h2>
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="admin/product_create.php" 
               style="display: inline-block; padding: 12px 25px; background: #f3961c; color: #3b141c; border-radius: 30px; font-weight: 600; text-decoration: none; transition: 0.3s;"
               onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
               onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">➕ Add New Product</a>

                <a href="admin/products_list.php" 
               style="display: inline-block; padding: 12px 25px; background: #f3961c; color: #3b141c; border-radius: 30px; font-weight: 600; text-decoration: none; transition: 0.3s;"
               onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
               onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">Product List</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;" class="products-gallery">
            <?php foreach($products as $p): ?>
            <div style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; text-align: center; overflow: hidden; position: relative; transition: transform 0.3s, box-shadow 0.3s;backdrop-filter: blur(10px);" 
                 class="product-card"
                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.2)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                
                <div style="position: relative; width: 100%; height: 250px; overflow: hidden; border-radius: 15px; margin-bottom: 15px;" class="carousel">
                    <img src="uploads/<?= htmlspecialchars($p['image']) ?>" 
                         style="width: 100%; height: 100%; object-fit: contain; position: absolute; top: 0; left: 0; opacity: 1; transition: opacity 1s ease-in-out;" 
                         class="active">
                    <?php if(!empty($p['image2'])): ?>
                    <img src="uploads/<?= htmlspecialchars($p['image2']) ?>" 
                         style="width: 100%; height: 100%; object-fit: contain; position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 1s ease-in-out;">
                    <?php endif; ?>
                </div>
                
                <div class="product-details">
                    <h3 style="color: #fff; margin-bottom: 10px; font-size: 1.2rem; font-weight: 600;"><?= htmlspecialchars($p['name']) ?></h3>
                    <p style="color: #eee; font-size: 1rem; margin-bottom: 10px; line-height: 1.4;"><?= htmlspecialchars($p['description']) ?></p>
                    <span style="font-weight: 600; color: #f3961c; font-size: 1.1rem;">LKR <?= number_format($p['price'],2) ?></span>
                    <br><br>
                </div>
                
                <div style="display: flex; gap: 10px; justify-content: center;">
                    <a href="admin/products_edit.php?id=<?= $p['id'] ?>" 
                       style="padding: 8px 15px; border-radius: 20px; font-weight: 600; text-decoration: none; background: #3b141c; color: #f3961c; transition: 0.3s;"
                       onmouseover="this.style.background='#f3961c'; this.style.color='#3b141c';"
                       onmouseout="this.style.background='#3b141c'; this.style.color='#f3961c';">Edit</a>
                    
                    <a href="admin/products_delete.php?id=<?= $p['id'] ?>" 
                       onclick="return confirm('Are you sure?');" 
                       style="padding: 8px 15px; border-radius: 20px; font-weight: 600; text-decoration: none; background: #f3961c; color: #3b141c; transition: 0.3s;"
                       onmouseover="this.style.background='#3b141c'; this.style.color='#f3961c';"
                       onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c';">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</main>

<script>
let heroImages = document.querySelectorAll('.hero-carousel img');
let heroIndex = 0;
setInterval(() => {
    heroImages.forEach(img => img.style.opacity = '0');
    heroIndex = (heroIndex + 1) % heroImages.length;
    heroImages[heroIndex].style.opacity = '1';
}, 3000);

document.querySelectorAll('.products-gallery .carousel').forEach(carousel=>{
    const images = carousel.querySelectorAll('img');
    let index=0;
    if(images.length > 1) {
        setInterval(()=>{
            images.forEach(img=>img.style.opacity = '0');
            index = (index+1)%images.length;
            images[index].style.opacity = '1';
        }, 3000);
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