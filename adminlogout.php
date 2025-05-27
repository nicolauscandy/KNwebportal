<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: adminlogin.php");
    exit;
}

// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: adminlogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout</title>
    <link rel="stylesheet" href="adminlogout.css">
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 600px;
    width: 100%;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    text-align: center;
}

h1 {
    color: #007bff;
}

p {
    font-size: 16px;
    color: #666;
}

.button {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #0056b3;
}

        </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin! You are logged in.</p>
        <form action="" method="post">
            <div class="form-group">
                <button type="submit">Logout</button>
            </div>
        </form>
    </div>
</body>
</html>