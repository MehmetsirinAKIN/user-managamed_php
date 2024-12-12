<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo "Kullanıcı başarıyla silindi.";
        } else {
            echo "Kullanıcı silinirken bir hata oluştu.";
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
?>
