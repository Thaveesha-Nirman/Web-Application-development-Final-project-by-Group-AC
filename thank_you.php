<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - SP Mobiles</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .thank-you-container {
            text-align: center;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 60px 40px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .success-icon {
            font-size: 5rem;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        .brand-section {
            margin-bottom: 30px;
        }

        .brand-logo {
            color: #f3961c;
            font-family: 'Miniver', cursive;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .main-title {
            color: #f3961c;
            font-family: 'Miniver', cursive;
            font-size: 2.8rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 500;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .description {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .order-info {
            background: rgba(243, 150, 28, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border: 1px solid rgba(243, 150, 28, 0.3);
        }

        .order-info h3 {
            color: #f3961c;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .info-list {
            color: #fff;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .info-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 8px 0;
        }

        .info-item .icon {
            margin-right: 10px;
            color: #f3961c;
        }

        .actions-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .btn-home {
            display: inline-block;
            padding: 15px 40px;
            background: #f3961c;
            color: #3b141c;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            font-family: 'Roboto', sans-serif;
        }

        .btn-home:hover {
            background: #3b141c;
            color: #f3961c;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(243, 150, 28, 0.4);
        }

        .btn-secondary {
            display: inline-block;
            padding: 12px 30px;
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
            transform: translateY(-2px);
        }

        .decorative-elements {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .social-proof {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-proof p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .thank-you-container {
                padding: 40px 25px;
                margin: 20px;
            }
            
            .success-icon {
                font-size: 4rem;
            }
            
            .main-title {
                font-size: 2.2rem;
            }
            
            .brand-logo {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .btn-home {
                padding: 12px 30px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .thank-you-container {
                padding: 30px 20px;
            }
            
            .success-icon {
                font-size: 3.5rem;
            }
            
            .main-title {
                font-size: 1.8rem;
            }
            
            .actions-section {
                gap: 12px;
            }
            
            .info-item {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<div class="decorative-elements">📱💫</div>

<div class="thank-you-container">
    <div class="success-icon">🎉</div>
    
    <div class="brand-section">
        <div class="brand-logo">SP Mobiles</div>
    </div>
    
    <h1 class="main-title">Order Confirmed!</h1>
    <p class="subtitle">Thank you for choosing SP Mobiles</p>
    
    <p class="description">
        We've successfully received your order and our team is already preparing it for delivery. 
        You'll receive updates on your order progress soon!
    </p>
    
    <div class="order-info">
        <h3>🚀 What happens next?</h3>
        <div class="info-list">
            <div class="info-item">
                <span class="icon">📧</span>
                <span>Order confirmation email sent</span>
            </div>
            <div class="info-item">
                <span class="icon">📦</span>
                <span>Order processing within 24 hours</span>
            </div>
            <div class="info-item">
                <span class="icon">🚛</span>
                <span>Fast delivery to your doorstep</span>
            </div>
            <div class="info-item">
                <span class="icon">💳</span>
                <span>Pay conveniently on delivery</span>
            </div>
        </div>
    </div>
    
    <div class="actions-section">
        <a href="index.php" class="btn-home">🏠 Back to Home</a>
        <a href="galary.php" class="btn-secondary">🛍️ Continue Shopping</a>
    </div>
    
    <div class="social-proof">
        <p>"Your trusted partner for mobile phones & accessories"</p>
    </div>
</div>

</body>
</html>