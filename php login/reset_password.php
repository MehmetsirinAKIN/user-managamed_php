<?php
// Veritabanı bağlantısını yap
include 'db_connection.php';

$newPassword = $_POST['new_password'];
$email = $_POST['email']; // E-posta doğrulama sırasında gönderilmeli

// Şifreyi hashle
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Şifreyi güncelle
$query = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
$success = $query->execute([$hashedPassword, $email]);

if ($success) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Şifre güncellenemedi.']);
}
?>
