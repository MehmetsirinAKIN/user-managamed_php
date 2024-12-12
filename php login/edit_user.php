<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?");
        if ($stmt->execute([$firstName, $lastName, $email, $phone, $id])) {
            echo "Kullanıcı başarıyla güncellendi.";
        } else {
            echo "Kullanıcı güncellenirken bir hata oluştu.";
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
?>
