<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SP Mobiles</title>
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
        
        @media (max-width: 1024px) {
            .contact-container {
                grid-template-columns: 1fr !important;
                gap: 40px !important;
            }
        }
        
        @media (max-width: 768px) {
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
                width: 80px !important;
                height: 80px !important;
            }
            
            .contact-title h1 {
                font-size: 2rem !important;
            }
            
            .contact-title {
                margin-top: 50px !important;
                margin-bottom: 50px !important;
            }
            
            .contact-info,
            .contact-form,
            .map-section {
                padding: 25px !important;
            }
            
            .form-row {
                grid-template-columns: 1fr !important;
                gap: 15px !important;
            }
            
            .contact-section {
                padding-top: 50px !important;
            }
        }
        
        @media (max-width: 480px) {
            .nav-menu a {
                padding: 6px 10px !important;
                font-size: 0.8rem !important;
            }
            
            .info-item {
                flex-direction: column !important;
                text-align: center !important;
            }
            
            .info-icon {
                margin: 0 auto 15px !important;
            }
            
            .social-links {
                flex-wrap: wrap !important;
            }
            
            .contact-info,
            .contact-form,
            .map-section {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav style="padding: 20px; display: flex; align-items: center; justify-content: space-between; max-width: 1300px; margin: 0 auto;" class="navbar">
            <img src="uploads/WhatsApp_Image_2025-07-31_at_21.45.54_a2b8b8e3-removebg-preview.png" 
                 alt="" 
                 style="width: 130px; height: 130px;" class="logo-photo">
            
            <a href="index.php" style="text-decoration: none;">
                <h2 style="color: #fff; font-size: 2rem; font-weight: 600; margin-left: -10%; position=relative; text-align: left;" class="logo-text">SP Mobiles</h2>
            </a>
             <div style="background: rgba(255, 255, 255, 0.1); margin-left: 250px; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 25px; padding: 8px 15px; backdrop-filter: blur(10px);" class="user-info">
                        <span style="color: #f3961c; font-size: 0.9rem; font-weight: 600;">👋</span>
                        <span style="color: #fff; font-size: 0.9rem; font-weight: 500; margin-left: 5px;">Hellow !</span>
                    </div>
            <ul style="display: flex; gap: 10px; list-style: none; margin: 0; padding: 0;" class="nav-menu">
                
                <li><a href="index.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
                       onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Home</a></li>
                
                <li><a href="about.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">About</a></li>
                
                <li><a href="galary.php" 
                       style="padding: 10px 18px; color: #ffffffff;background='#3b141c'; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"
                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Gallery</a></li>
                       <li><a href="cart.php" 
                           style="padding: 8px 15px; background: rgba(243, 150, 28, 0.2); color: #ffffffff; border: 1px solid #f3961c; border-radius: 20px; font-size: 0.9rem; font-weight: 600; transition: 0.3s; text-decoration: none;"
onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"                           onmouseout="this.style.background='rgba(243, 150, 28, 0.2)'; this.style.color='#ffffffff';">🛒 Cart</a></li>
                
                <li><a href="contact-us.php" 
                       style="padding: 10px 18px; color: #fff; border-radius: 30px; font-size: 1.12rem; transition: 0.3s ease; text-decoration: none;"
onmouseover="this.style.color=' #f3961c'; this.style.background='#3b141c ';"                       onmouseout="this.style.color='#fff'; this.style.background='transparent';">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section style="padding-top: 120px; padding-bottom: 60px; min-height: 100vh; max-width: 1300px; margin: 0 auto; padding-left: 20px; padding-right: 20px;" class="contact-section">
            <div style="text-align: center; margin-top: 100px; margin-bottom: 100px;" class="contact-title">
                <h1 style="font-size: 2.3rem; color: #f3961c; font-family: Arial, Helvetica, sans-serif; margin-bottom: 15px;">Contact Us</h1>
                <p style="color: #fff; font-size: 1.12rem; font-weight: 500; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                    Get in touch with us for any inquiries about our premium smartphones or services. We're here to help!
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 50px;" class="contact-container">
                <div style="background: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 40px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); height: fit-content;" class="contact-info">
                    <h2 style="color: #f3961c; font-size: 1.5rem; font-weight: 600; margin-bottom: 30px;">Get In Touch</h2>
                    
                    <div style="display: flex; align-items: flex-start; margin-bottom: 25px; color: #fff;" class="info-item">
                        <div style="background: #f3961c; color: #3b141c; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-size: 1.12rem; font-weight: 700; flex-shrink: 0;" class="info-icon">📍</div>
                        <div>
                            <h3 style="font-size: 1.12rem; font-weight: 600; margin-bottom: 5px; color: #f3961c;">Address</h3>
                            <p style="font-size: 1rem; line-height: 1.5; color: #fff;">123 Mobile Street, Tangalle, Southern Province, Sri Lanka</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; margin-bottom: 25px; color: #fff;" class="info-item">
                        <div style="background: #f3961c; color: #3b141c; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-size: 1.12rem; font-weight: 700; flex-shrink: 0;" class="info-icon">📞</div>
                        <div>
                            <h3 style="font-size: 1.12rem; font-weight: 600; margin-bottom: 5px; color: #f3961c;">Phone</h3>
                            <p style="font-size: 1rem; line-height: 1.5; color: #fff;">+94 77 123 4567<br>+94 11 234 5678</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; margin-bottom: 25px; color: #fff;" class="info-item">
                        <div style="background: #f3961c; color: #3b141c; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-size: 1.12rem; font-weight: 700; flex-shrink: 0;" class="info-icon">📧</div>
                        <div>
                            <h3 style="font-size: 1.12rem; font-weight: 600; margin-bottom: 5px; color: #f3961c;">Email</h3>
                            <p style="font-size: 1rem; line-height: 1.5; color: #fff;">info@spmobiles.lk<br>support@spmobiles.lk</p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; margin-bottom: 25px; color: #fff;" class="info-item">
                        <div style="background: #f3961c; color: #3b141c; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-size: 1.12rem; font-weight: 700; flex-shrink: 0;" class="info-icon">🕒</div>
                        <div>
                            <h3 style="font-size: 1.12rem; font-weight: 600; margin-bottom: 5px; color: #f3961c;">Business Hours</h3>
                            <p style="font-size: 1rem; line-height: 1.5; color: #fff;">Monday - Saturday: 9:00 AM - 7:00 PM<br>Sunday: 10:00 AM - 5:00 PM</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; margin-top: 30px; justify-content: center;" class="social-links">
                        <a href="#" style="width: 50px; height: 50px; background: #f3961c; color: #3b141c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.12rem; font-weight: 700; transition: 0.3s ease; text-decoration: none;"
                           onmouseover="this.style.background='transparent'; this.style.color='#fff'; this.style.border='2px solid #fff';"
                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.border='none';">📘</a>
                        <a href="#" style="width: 50px; height: 50px; background: #f3961c; color: #3b141c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.12rem; font-weight: 700; transition: 0.3s ease; text-decoration: none;"
                           onmouseover="this.style.background='transparent'; this.style.color='#fff'; this.style.border='2px solid #fff';"
                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.border='none';">📷</a>
                        <a href="#" style="width: 50px; height: 50px; background: #f3961c; color: #3b141c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.12rem; font-weight: 700; transition: 0.3s ease; text-decoration: none;"
                           onmouseover="this.style.background='transparent'; this.style.color='#fff'; this.style.border='2px solid #fff';"
                           onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.border='none';">💬</a>
                    </div>
                </div>

                <div style="background: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 40px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);" class="contact-form">
                    <h2 style="color: #f3961c; font-size: 1.5rem; font-weight: 600; margin-bottom: 30px;">Send Message</h2>
                    
                    <form action="#" method="POST">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;" class="form-row">
                            <div>
                                <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">First Name</label>
                                <input type="text" 
                                       name="first_name" 
                                       placeholder="Enter your first name"
                                       style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease;"
                                       onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';">
                            </div>
                            <div>
                                <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">Last Name</label>
                                <input type="text" 
                                       name="last_name" 
                                       placeholder="Enter your last name"
                                       style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease;"
                                       onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';">
                            </div>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">Email</label>
                            <input type="email" 
                                   name="email" 
                                   placeholder="Enter your email"
                                   style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease;"
                                   onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';">
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">Phone</label>
                            <input type="tel" 
                                   name="phone" 
                                   placeholder="Enter your phone number"
                                   style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease;"
                                   onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';">
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">Subject</label>
                            <select name="subject" 
                                    style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease;"
                                    onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                    onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="sales">Sales Question</option>
                                <option value="feedback">Feedback</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; color: #fff; font-size: 1rem; font-weight: 500; margin-bottom: 8px;">Message</label>
                            <textarea name="message" 
                                      placeholder="Enter your message"
                                      style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; color: #fff; font-size: 1rem; transition: 0.3s ease; resize: vertical; min-height: 120px;"
                                      onfocus="this.style.borderColor='#f3961c'; this.style.background='rgba(255, 255, 255, 0.15)';"
                                      onblur="this.style.borderColor='rgba(255, 255, 255, 0.3)'; this.style.background='rgba(255, 255, 255, 0.1)';"></textarea>
                        </div>

                        <button type="submit" 
                                style="width: 100%; padding: 15px 30px; background: #f3961c; color: #3b141c; border: 2px solid transparent; border-radius: 30px; font-size: 1.12rem; font-weight: 600; cursor: pointer; transition: 0.3s ease; margin-top: 10px;"
                                onmouseover="this.style.background='transparent'; this.style.color='#fff'; this.style.borderColor='#fff';"
                                onmouseout="this.style.background='#f3961c'; this.style.color='#3b141c'; this.style.borderColor='transparent';">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <div style="margin-top: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 40px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);" class="map-section">
                <h2 style="color: #f3961c; font-size: 1.5rem; font-weight: 600; margin-bottom: 20px; text-align: center;">Find Us</h2>
                <div style="width: 100%; height: 300px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.12rem; border: 2px dashed rgba(255, 255, 255, 0.3);">
                    🗺️ Interactive Map Coming Soon - SP Mobiles Location
                </div>
            </div>
        </section>
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