<?php
// Veritabanı bağlantısını yap
include 'includes/db.php';

$email = trim($_POST['email']); // E-posta girdisini temizle
$phone = trim($_POST['phone']); // Telefon girdisini temizle
// Kullanıcıyı kontrol et
$query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND phone = ?");
$query->execute([$email, $phone]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['status' => 'verified']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Bilgiler uyuşmuyor.']);
}
?>
