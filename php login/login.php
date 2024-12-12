<?php
session_start();


require_once 'includes/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Kullanıcıyı al
$query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$query->execute([$email]);
$user = $query->fetch();

if (!$user) {
 
    echo "<script>window.location.href = 'index.php?error=invalid_credentials';</script>";
    exit();
}

// Şifre doğrulama
if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $response = [
        'status' => 'success',
        'message' => 'Login successful',
        'user_id' => $user['id']
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid credentials'
    ];
}

// JSON yanıt döndürme
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
