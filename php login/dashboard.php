<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Yönetimi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            
            background-size: cover; /* Görseli tüm ekrana yay */
            background-position: center; /* Görseli ortala */
            background-attachment: fixed; /* Parallax etkisi için sabitle */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', Arial, sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.85); /* Saydam beyaz arka plan */
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hafif gölge */
            padding: 20px;
            max-width: 400px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.5rem;
            text-align: center;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        button {
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
       
    </style>


</head>

<body>
<div class="container mt-5">
    <h1 class="text-center" style="font-size: 2.5rem; font-weight: bold;">Kullanıcı Yönetimi</h1>
    <button id="addUserBtn" class="btn btn-primary mb-3">Yeni Kullanıcı Ekle</button>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Soyad</th>
            <th>E-posta</th>
            <th>Telefon</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody id="userTable">
        </tbody>
    </table>
</div>
<?php include 'C:\xampp\htdocs\task\user_form _modal.php';  ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function loadUsers() {
        $.get('get_users.php', function (data) {
            $('#userTable').html(data);
        });
    }
    loadUsers();



    $(document).ready(function () {
    // Modal'ı aç
    $('#addUserBtn').on('click', function () {
        $('#addUserModal').modal('show');
    });

    // Form gönderildiğinde kullanıcıyı ekle
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'add_user.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#addUserModal').modal('hide'); // Modal'ı kapat
                $('#addUserForm')[0].reset(); // Formu temizle
                loadUsers(); // Kullanıcıları yeniden yükle
                alert(response); // İşlem sonucunu göster
            },
            error: function () {
                alert('Kullanıcı eklenirken bir hata oluştu.');
            }
        });
    });
});




//silme ve guncelleme 
$(document).ready(function () {
    // "Sil" butonuna tıklandığında
    $(document).on('click', '.deleteUserBtn', function () {
        const userId = $(this).data('id');
        if (confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { id: userId },
                success: function (response) {
                    alert(response);
                    loadUsers(); // Tabloyu güncelle
                },
                error: function () {
                    alert('Kullanıcı silinirken bir hata oluştu.');
                }
            });
        }
    });

    // "Düzenle" butonuna tıklandığında
    $(document).on('click', '.editUserBtn', function () {
        const userId = $(this).data('id');

        // Mevcut kullanıcı bilgilerini modal içine yükle
        $.get('get_user_details.php', { id: userId }, function (data) {
            const user = JSON.parse(data);
            $('#firstName').val(user.first_name);
            $('#lastName').val(user.last_name);
            $('#email').val(user.email);
            $('#phone').val(user.phone);
            $('#password').prop('required', false); // Şifre alanını boş bırak
            $('#addUserModal').modal('show');
            $('#addUserForm').data('action', 'edit').data('id', userId);
        });
    });

    // Modal form gönderildiğinde
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        const action = $(this).data('action');
        const url = action === 'edit' ? 'edit_user.php' : 'add_user.php';
        const userId = $(this).data('id') || null;

        const data = $(this).serialize() + (action === 'edit' ? `&id=${userId}` : '');
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                $('#addUserModal').modal('hide');
                $('#addUserForm')[0].reset();
                loadUsers();
                alert(response);
            },
            error: function () {
                alert('Bir hata oluştu. adduserform');
            }
        });
    });
});


</script>
</body>
</html>
