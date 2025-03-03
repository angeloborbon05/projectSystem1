<?php
session_start();
require_once '../config/database.php';

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user credentials are correct
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) { // Directly compare plain text password
            $_SESSION['user'] = $user;
            if (isset($user['user_type'])) {
                if ($user['user_type'] == 'donor') {
                    header('Location: ../donors/donors_dashboard.php');
                } else if ($user['user_type'] == 'beneficiary') {
                    header('Location: ../beneficiaries/beneficiaries_dashboard.php');
                } else if ($user['user_type'] == 'admin') {
                    header('Location: ../admin/admin_dashboard.php');
                }
                exit();
            } else {
                $_SESSION['error'] = 'User type not set. Please contact support.';
            }
        } else {
            $_SESSION['error'] = 'Invalid email or password';
        }
    } else {
        $_SESSION['error'] = 'Invalid email or password';
    }
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>