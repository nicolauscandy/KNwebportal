<?php
$host = "localhost";
$user = "root"; // Your database username
$pass = ""; // Your database password (empty for default XAMPP setup)
$dbname = "woodworks"; // Your database name

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Check if product ID is provided
    if (!isset($_GET['id'])) {
        die("Error: No product ID provided.");
    }

    $productId = $_GET['id'];

    // Prepare SQL statement
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch product data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("Error: Product not found.");
    }

    // Display product details
    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "<div class='price'>Rs: " . htmlspecialchars($row['price']) . "</div>";

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
