<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

require_role(['admin','superadmin']);

$orders = $mysqli->query("SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders - SP Mobiles Admin</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
        }

        .admin-badge {
            display: inline-block;
            background: rgba(243, 150, 28, 0.2);
            border: 1px solid #f3961c;
            border-radius: 25px;
            padding: 8px 20px;
            margin-bottom: 15px;
            color: #f3961c;
            font-weight: 600;
            font-size: 0.9rem;
        }

        h1 {
            color: #f3961c;
            font-family: 'Miniver', cursive;
            font-size: 2.8rem;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #fff;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .orders-table-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table thead tr {
            background: rgba(59, 20, 28, 0.7);
        }

        .orders-table th {
            padding: 18px 15px;
            color: #f3961c;
            font-weight: 700;
            font-size: 1.05rem;
            text-align: center;
            border-bottom: 2px solid rgba(243, 150, 28, 0.3);
        }

        .orders-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: top;
        }

        .orders-table tbody tr {
            transition: all 0.3s ease;
        }

        .orders-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-1px);
        }

        .order-id {
            background: rgba(243, 150, 28, 0.2);
            border-radius: 20px;
            padding: 5px 12px;
            font-weight: 700;
            color: #f3961c;
            display: inline-block;
        }

        .customer-name {
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
        }

        .customer-details {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        .total-amount {
            color: #f3961c;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .order-date {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .order-items {
            background: rgba(59, 20, 28, 0.3);
            border-radius: 8px;
            padding: 10px;
            max-width: 200px;
            margin: 0 auto;
        }

        .item-line {
            color: #fff;
            font-size: 0.85rem;
            margin-bottom: 3px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-name {
            color: #f3961c;
            font-weight: 600;
        }

        .item-quantity {
            background: rgba(243, 150, 28, 0.2);
            border-radius: 12px;
            padding: 2px 8px;
            font-weight: 600;
            color: #f3961c;
            font-size: 0.8rem;
        }

        .actions-section {
            text-align: center;
            margin-top: 40px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-back {
            display: inline-block;
            padding: 15px 35px;
            background: #f3961c;
            color: #3b141c;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #3b141c;
            color: #f3961c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 150, 28, 0.3);
        }

        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px 25px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            min-width: 150px;
        }

        .stat-number {
            color: #f3961c;
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            color: #fff;
            font-size: 0.9rem;
            margin-top: 5px;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .orders-table-container {
                overflow-x: auto;
            }
            
            .orders-table {
                min-width: 800px;
            }
            
            .orders-table th,
            .orders-table td {
                padding: 10px 8px;
                font-size: 0.9rem;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .stats-bar {
                gap: 15px;
            }
            
            .stat-item {
                min-width: 120px;
                padding: 15px 20px;
            }
        }

        @media (max-width: 480px) {
            .orders-table th,
            .orders-table td {
                padding: 8px 6px;
                font-size: 0.8rem;
            }
            
            .order-items {
                max-width: 150px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <div class="admin-badge">⚙️ Admin Panel</div>
        <h1>Customer Orders</h1>
        <p class="subtitle">Manage and track all customer orders</p>
    </div>

    <?php
    $total_orders = $orders->num_rows;
    $orders->data_seek(0);
    $total_revenue = 0;
    $temp_orders = [];
    while($temp_order = $orders->fetch_assoc()) {
        $temp_orders[] = $temp_order;
        $total_revenue += $temp_order['total_amount'];
    }
    $orders->data_seek(0);
    ?>

    <div class="stats-bar">
        <div class="stat-item">
            <span class="stat-number"><?= $total_orders ?></span>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-item">
            <span class="stat-number">LKR <?= number_format($total_revenue, 0) ?></span>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-item">
            <span class="stat-number">LKR <?= $total_orders > 0 ? number_format($total_revenue / $total_orders, 0) : '0' ?></span>
            <div class="stat-label">Avg Order Value</div>
        </div>
    </div>

    <div class="orders-table-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Contact Info</th>
                    <th>Address</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = $orders->fetch_assoc()): ?>
                <tr>
                    <td>
                        <div class="order-id">#<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?></div>
                    </td>
                    <td>
                        <div class="customer-name"><?= htmlspecialchars($order['customer_name']) ?></div>
                    </td>
                    <td>
                        <div class="customer-details">
                            📧 <?= htmlspecialchars($order['customer_email']) ?><br>
                            📱 <?= htmlspecialchars($order['customer_phone']) ?>
                        </div>
                    </td>
                    <td>
                        <div class="customer-details">🏠 <?= htmlspecialchars($order['customer_address']) ?></div>
                    </td>
                    <td>
                        <div class="total-amount">LKR <?= number_format($order['total_amount'], 2) ?></div>
                    </td>
                    <td>
                        <div class="order-date">
                            📅 <?= date('M j, Y', strtotime($order['created_at'])) ?><br>
                            🕒 <?= date('g:i A', strtotime($order['created_at'])) ?>
                        </div>
                    </td>
                    <td>
                        <div class="order-items">
                            <?php
                            $stmt = $mysqli->prepare("SELECT products.name, order_items.quantity 
                                                      FROM order_items 
                                                      JOIN products ON order_items.product_id = products.id 
                                                      WHERE order_items.order_id=?");
                            $stmt->bind_param("i", $order['id']);
                            $stmt->execute();
                            $items = $stmt->get_result();
                            while($item = $items->fetch_assoc()):
                            ?>
                            <div class="item-line">
                                <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                                <span class="item-quantity">×<?= $item['quantity'] ?></span>
                            </div>
                            <?php endwhile; ?>
                            <?php $stmt->close(); ?>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="actions-section">
        <a href="index.php" class="btn-back">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>