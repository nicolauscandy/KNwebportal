<?php
include 'C:\xampp\woodworks\htdocs\woodworks\website\config\db.php';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $project = $conn->real_escape_string($_POST['project']);
    $budget = $conn->real_escape_string($_POST['budget']);
    $timeline = $conn->real_escape_string($_POST['timeline']);

    // Insert data into the database
    $sql = "INSERT INTO quotes (name, email, phone, project_description, budget, timeline) VALUES ('$name', '$email', '$phone', '$project', '$budget', '$timeline')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Order submitted successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get a Quote - Woodworks Company</title>
    <link rel="stylesheet" href="quotestyle.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background:linear-gradient(#ffff,#708090);
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.header {
    background-color:lightgrey;
    color: black;
    padding: 20px;
    text-align: center;
    margin-bottom: 50px solid #333;
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
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

h2 {
    color:black;
}

p {
    font-size: 16px;
    color: black;
    line-height: 1.6;
    max-width: 800px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
    width: 100%;
    max-width: 600px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group textarea {
    width: calc(500px - 50px);
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #333;
    border-radius: 5px;
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
        <h1>GET A QUOTE</h1>
    </header>
    <div class="container">
        <h2>Request a Quote for Your Woodwork Project</h2>
        <p>Please fill out the form below, and we'll get back to you with a detailed quote as soon as possible.</p>
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
                <label for="project">Project Description</label>
                <textarea id="project" name="project" placeholder="Briefly describe your project" required></textarea>
            </div>
            <div class="form-group">
                <label for="budget">Estimated Budget</label>
                <input type="text" id="budget" name="budget" placeholder="Your Estimated Budget" required>
            </div>
            <div class="form-group">
                <label for="timeline">Preferred Timeline</label>
                <input type="text" id="timeline" name="timeline" placeholder="Your Preferred Timeline" required>
            </div>
            <div class="form-group">
                <button type="submit">Get a Quote</button>
            </div>
        </form>
    </div>
</body>
</html>
