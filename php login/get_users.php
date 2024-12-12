<?php
require_once 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM users");
while ($row = $stmt->fetch()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['first_name']}</td>
            <td>{$row['last_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>
                <button class='btn btn-warning btn-sm editUserBtn' data-id='{$row['id']}'>Düzenle</button>
                <button class='btn btn-danger btn-sm deleteUserBtn' data-id='{$row['id']}'>Sil</button>
            </td>
          </tr>";
}
?>
