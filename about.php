<?php
session_start();
require 'includes/db.php';
require 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About Us - SP Mobiles</title>
    <link rel="stylesheet" href="about.css">
</head>
<body>
<div class="mysite">
    <header>
        <nav class="navbar section-content">
            <a href="index.php" class="nav-logo">
                <img src="uploads/WhatsApp_Image_2025-07-31_at_21.45.54_a2b8b8e3-removebg-preview.png" alt="SP Logo" class="logo-photo">
                <h2 class="logo-text">SP Mobiles</h2>
                
                

            </a>
            
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="galary.php" class="nav-link1">Gallery</a></li>
                <li class="nav-item"><a href="contact-us.php" class="nav-link1">Contact</a></li>

                <?php if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['admin','superadmin'])): ?>
                    <li class="nav-item"><a href="admin/index.php" class="nav-link1">Admin Dashboard</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link1">Logout</a></li>
                <?php elseif(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link1">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="login.php" class="nav-link1">Login</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link1">Create Account</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="about-section">
            <div class="section-content">
                <div class="about-hero">
                    <h1 class="title">About SP Mobiles</h1>
                    <h2 class="subtitle">Your Trusted Mobile Technology Partner</h2>
                    <p class="description">
                        At SP Mobiles, we've been connecting people through cutting-edge mobile technology for years. 
                        We believe that everyone deserves access to the latest smartphones and the best service experience. 
                        Our commitment to quality, reliability, and customer satisfaction has made us a leading name in the mobile industry.
                    </p>
                </div>

                <div class="story-section">
                    <div class="story-content">
                        <h3>Our Story</h3>
                        <p>
                            SP Mobiles started with a simple vision: to make premium mobile technology accessible to everyone. 
                            What began as a small local shop has grown into a trusted mobile retailer, serving thousands of 
                            satisfied customers.
                        </p>
                        <p>
                            We understand that your phone is more than just a device - it's your connection to the world, 
                            your camera for precious memories, and your companion for daily life. That's why we only offer 
                            the best quality phones and provide exceptional after-sales support.
                        </p>
                    </div>
                    <img src="uploads/aphoto.png" alt="SP Mobiles Store">
                </div>

                <div class="values-section">
                    <h3>Why Choose SP Mobiles?</h3>
                    <div class="values-grid">
                        <div class="value-card">
                            <div class="icon">📱</div>
                            <h4>Quality Products</h4>
                            <p>We offer only genuine, high-quality mobile phones from trusted brands. Every device comes with proper warranty and authenticity guarantee.</p>
                        </div>
                        <div class="value-card">
                            <div class="icon">🛠️</div>
                            <h4>Expert Service</h4>
                            <p>Our skilled technicians provide professional repair services, maintenance, and technical support to keep your device running perfectly.</p>
                        </div>
                        <div class="value-card">
                            <div class="icon">💰</div>
                            <h4>Best Prices</h4>
                            <p>We offer competitive pricing without compromising on quality. Get the best value for your money with our special deals and offers.</p>
                        </div>
                        <div class="value-card">
                            <div class="icon">🤝</div>
                            <h4>Customer First</h4>
                            <p>Your satisfaction is our priority. We provide personalized service, honest advice, and ongoing support for all your mobile needs.</p>
                        </div>
                    </div>
                </div>

                <div class="team-section">
                    <h3>Meet Our Team</h3>
                    <div class="team-grid">
                        <div class="team-card">
                            <div class="avatar">SP</div>
                            <h4>Thaveesha Nirman</h4>
                            <div class="role">Founder & CEO</div>
                            <p>With over 10 years in mobile technology, Suresh leads SP Mobiles with passion for innovation and customer service.</p>
                        </div>
                        <div class="team-card">
                            <div class="avatar">TS</div>
                            <h4>Technical Support</h4>
                            <div class="role">Repair Specialists</div>
                            <p>Our certified technicians handle all repairs and technical issues with expertise and care for your devices.</p>
                        </div>
                        <div class="team-card">
                            <div class="avatar">CS</div>
                            <h4>Customer Service</h4>
                            <div class="role">Sales Team</div>
                            <p>Friendly and knowledgeable staff ready to help you find the perfect mobile phone for your needs and budget.</p>
                        </div>
                    </div>
                </div>

                <div class="cta-section">
                    <h3>Ready to Experience the SP Mobiles Difference?</h3>
                    <p>
                        Join thousands of satisfied customers who trust SP Mobiles for their mobile technology needs. 
                        Visit our gallery to see our latest collection or contact us for personalized service.
                    </p>
                    <div class="cta-buttons">
                        <a href="galary.php" class="cta-button">View Our Gallery</a>
                        <a href="contact-us.php" class="cta-button secondary">Contact Us Today</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
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
