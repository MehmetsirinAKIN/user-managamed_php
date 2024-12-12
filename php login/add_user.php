<?php
require_once 'includes/db.php';

// Yeni kullanıcı bilgileri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; // Kullanıcının şifresi

    // Şifreyi hashleyin
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Aynı e-posta adresinin zaten var olup olmadığını kontrol et
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "Bu e-posta adresi zaten kayıtlı!";
            exit;
        }

        // Kullanıcıyı eklemek için sorgu
        $query = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$firstName, $lastName, $email, $phone, $hashedPassword]);
        echo "Yeni kullanıcı başarıyla eklendi!";
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
} else {
    echo "Geçersiz istek.";
}
?>
