<?php
include 'C:\xampp\woodworks\htdocs\woodworks\website\config\db.php';


// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $furniture_type = $conn->real_escape_string($_POST['furniture-type']);
    $dimensions = $conn->real_escape_string($_POST['dimensions']);
    $material = $conn->real_escape_string($_POST['material']);
    $additional_info = $conn->real_escape_string($_POST['additional-info']);

    // Insert data into the database
    $sql = "INSERT INTO custom_orders (name, email, phone, address, furniture_type, dimensions, material, additional_info) 
            VALUES ('$name', '$email', '$phone', '$address', '$furniture_type', '$dimensions', '$material', '$additional_info')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Order submitted successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Custom Furniture - Furniture Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(#fff, #708090);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .header {
            background-color: lightgrey;
            color: black;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .container {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 20px;
            text-align: left;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #333;
            border-radius: 5px;
        }
        .form-group select {
            height: 40px;
        }
        .form-group textarea {
            height: 100px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Order Custom Furniture</h1>
    </header>
    <div class="container">
        <h2>Customize Your Furniture</h2>
        <p>Please fill out the form below to place your custom furniture order. Our team will review your requirements and get back to you with a quote and timeline.</p>
        <div class="card">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Your Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="Your Address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="furniture-type">Type of Furniture</label>
                    <select id="furniture-type" name="furniture-type" required>
                        <option value="sofa">Sofa</option>
                        <option value="dining-table">Dining Table</option>
                        <option value="bed">Bed</option>
                        <option value="chair">Chair</option>
                        <option value="cabinet">Cabinet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dimensions">Dimensions (LxWxH)</label>
                    <input type="text" id="dimensions" name="dimensions" placeholder="e.g., 200cm x 150cm x 90cm" required>
                </div>
                <div class="form-group">
                    <label for="material">Preferred Material</label>
                    <input type="text" id="material" name="material" placeholder="e.g., Teak, Oak, Mahogany" required>
                </div>
                <div class="form-group">
                    <label for="additional-info">Additional Information</label>
                    <textarea id="additional-info" name="additional-info" placeholder="Any additional details or specifications" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Submit Order</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
