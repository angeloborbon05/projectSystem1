<?php
session_start();
require_once '../config/database.php'; // Include your database connection file

// Check if the beneficiary is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] != 'beneficiary') {
    header('Location: ../auth/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Dashboard</title>
    <link rel="stylesheet" href="../auth/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<div class="container">
    <h1 class="form-title">Beneficiary Dashboard</h1>
    <p>Hello, <?php echo $_SESSION['user']['email']; ?>!</p>
    <a href="../auth/logout.php" class="btn">Logout</a>
</div>
</body>
</html>
