<?php
include 'C:\xampp\woodworks\htdocs\woodworks\website\config\db.php';

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'woodworks');
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert form data into the database
    $sql = "INSERT INTO contactus (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for your message! We will get back to you shortly.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
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
    <title>Contact Us - Furniture Store</title>
    <link rel="stylesheet" href="contactstyle.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background:linear-gradient(white,grey,white);
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.header {
    background-color:lightgrey;
    color: black;
    padding: 10px;
    text-align: center;
    margin-bottom: 10px; /* Add margin below the header */
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

.nav a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-size: 18px;
}

.nav a:hover {
    text-decoration: underline;
}

.container {
    flex: 1;
    padding: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

h2 {
    color: black;
}

p {
    font-size: 16px;
    color: black;
    line-height: 1.6;
    max-width: 600px;
    margin-bottom: 20px;
}

.card {
    background-color: lightgrey;
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
.form-group textarea {
    width: calc(100% - 22px);
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #333;
    border-radius: 5px;
}

.form-group textarea {
    height: 100px;
}

.form-group button {
    width: 300;
    padding: 10px;
    text-align: center;
    background-color: white;
    color: black;
    border:1px solid #333;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

.form-group button:hover {
    background-color: lightgray;
}
    </style>
</head>
<body>
    <header class="header">
        <h1> CONTACT US </h1>
    </header>
    <div class="container">
        <h2>Get in Touch</h2>
        <p>If you have any questions or need further information, please fill out the form below, and we'll get back to you as soon as possible.</p>
        <div class="card">
            <form action="contactus.php" method="post">
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
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
