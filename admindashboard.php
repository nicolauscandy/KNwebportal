<?php
// Database connection settings
$host = "localhost";
$username = "root"; // Use your DB username here
$password = ""; // Use your DB password here
$dbname = "woodworks"; // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$cart_sql = "SELECT * FROM cart";
$contact_sql = "SELECT * FROM contactus";
$custom_orders_sql = "SELECT * FROM custom_orders";
$orders_sql = "SELECT * FROM orders";
$order_items_sql = "SELECT * FROM order_items";
$quotes_sql = "SELECT * FROM quotes";


$cart_result = $conn->query($cart_sql);
$contact_result = $conn->query($contact_sql);
$custom_orders_result = $conn->query($custom_orders_sql);
$orders_result = $conn->query($orders_sql);
$order_items_result = $conn->query($order_items_sql);
$quotes_result = $conn->query($quotes_sql);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        header h1 {
            font-size: 24px;
        }
        .logout-button {
            position: absolute;
            right: 20px;
            top: 20px;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        caption {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <form action="admindashboard.php" method="POST">
            <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
    </header>

    
        <h2>Contact Us Messages</h2>
        <table>
            <caption>Contact Form Messages</caption>
            <thead>
                <tr>
                  
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contact_result->num_rows > 0): ?>
                    <?php while ($row = $contact_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['message']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No messages found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Custom Orders</h2>
        <table>
            <caption>Custom Order Requests</caption>
            <thead>
                <tr>
                    
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Furniture Type</th>
                    <th>Dimensions</th>
                    <th>Material</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($custom_orders_result->num_rows > 0): ?>
                    <?php while ($row = $custom_orders_result->fetch_assoc()): ?>
                        <tr>
                            
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['furniture_type']); ?></td>
                            <td><?= htmlspecialchars($row['dimensions']); ?></td>
                            <td><?= htmlspecialchars($row['material']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">No custom orders found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Orders</h2>
        <table>
        <caption>Order Details</caption>
<thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Payment Method</th>
        <th>Payment Details</th> <!-- New Column for Card Details -->
    </tr>
</thead>
<tbody>
<?php if ($orders_result && $orders_result->num_rows > 0): ?>
    <?php while ($row = $orders_result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['phone']); ?></td>
            <td><?= htmlspecialchars($row['address']); ?></td>
            <td><?= htmlspecialchars($row['payment_method']); ?></td>
            <td>
                <?php if ($row['payment_method'] === 'Card'): ?>
                    Cardholder: <?= htmlspecialchars($row['cardholder_name']); ?><br>
                    Card Number: **** **** **** <?= htmlspecialchars(substr($row['card_number'], -4)); ?><br>
                    Expiry Date: <?= htmlspecialchars($row['expiry_date']); ?><br>
                    CVV: *** <!-- Masked for security -->
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="6">No orders found</td></tr>
<?php endif; ?>
</tbody>
</table>


        <h2>Quotes</h2>
        <table>
            <caption>Quote Requests</caption>
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Project Description</th>
                    <th>Budget</th>
                    <th>Timeline</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($quotes_result->num_rows > 0): ?>
                    <?php while ($row = $quotes_result->fetch_assoc()): ?>
                        <tr>
                           
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['project_description']); ?></td>
                            <td><?= htmlspecialchars($row['budget']); ?></td>
                            <td><?= htmlspecialchars($row['timeline']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">No quotes found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
