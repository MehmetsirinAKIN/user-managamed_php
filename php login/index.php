<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Girişi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('https://images.pexels.com/photos/268533/pexels-photo-268533.jpeg');
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
            background: rgba(255, 255, 255, 0.55); /* Saydam beyaz arka plan */
            margin-left:100px ;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hafif gölge */
            padding: 20px;
            max-width: 500px;
            
        }
        .card-header {
            background-color:rgb(107, 139, 172);
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
<div id="formm" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Giriş Yap</div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginemail" class="form-label">E-posta</label>
                            <input type="text" class="form-control" id="loginemail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginpassword" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="loginpassword" name="password" required>
                        </div>
                        <div id="error" class="text-danger"></div>
                        <button type="submit" class="btn btn-primary w-100" id="loginBtn">Giriş Yap</button>
                        <button type="button" id="registerBtn" class="btn btn-secondary w-100" style="margin-top: 10px;">Kayıt Ol</button>
                        <!-- Şifremi Unuttum Butonu -->
                        <button type="button" id="forgotPasswordBtn" class="btn btn-link w-100 mt-2">Şifremi Unuttum</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Şifremi Unuttum Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordLabel">Şifremi Unuttum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="forgotEmail" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="forgotEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="forgotPhone" class="form-label">Telefon Numarası</label>
                        <input type="text" class="form-control" id="forgotPhone" name="phone" required>
                    </div>
                    <div id="forgotPasswordError" class="text-danger"></div>
                    <button type="submit" class="btn btn-primary w-100">Doğrula</button>
                </form>
                <form id="resetPasswordForm" style="display:none;" class="mt-3">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Yeni Şifre</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Yeni Şifre (Tekrar)</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                    </div>
                    <div id="resetPasswordError" class="text-danger"></div>
                    <button type="submit" class="btn btn-success w-100">Şifreyi Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>







<?php include 'C:\xampp\htdocs\task\user_form _modal.php';  ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = 'dashboard.php';
                } else {
                    $('#error').text("kullanıcı adı ve şifre hatalı ");
                }
            }
        });
    });



    // Kayıt ol butonuna tıklandığında modalı aç
    $('#registerBtn').on('click', function () {
        $('#addUserModal').modal('show');
    });

    $('#addUserModal').on('hidden.bs.modal', function () {
    // Modal kapandığında belirli bir düğmeye odaklan
    $('#registerBtn').focus();
});

    // Modal içindeki formu işlemek
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'add_user.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#addUserModal').modal('hide'); // Modalı kapat
                $('#addUserForm')[0].reset(); // Formu temizle
                alert(response); // İşlem sonucunu göster
            },
            error: function () {
                alert('Kullanıcı kaydı sırasında bir hata oluştu.');
            }
        });
    });

   

    // Şifremi Unuttum Modalını Aç
$('#forgotPasswordBtn').on('click', function () {
    $('#forgotPasswordModal').modal('show');
});

// Şifremi Unuttum Form İşleme
$('#forgotPasswordForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: 'verify_user.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            response = typeof response === 'string' ? JSON.parse(response) : response;

            console.log(response); // Yanıtı konsolda kontrol edin
            if (response.status === 'verified') {
                $('#forgotPasswordForm').hide();
                $('#resetPasswordForm').show();
            } else {
                $('#forgotPasswordError').text(response.message || 'E-posta veya telefon numarasıffff hatalı.');
            }
        },
        error: function () {
            $('#forgotPasswordError').text('Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    });
});

// Modal Kapandığında Doğrulama Ekranına Dön ve Tüm Alanları Temizle
$('#forgotPasswordModal').on('hidden.bs.modal', function () {
    // Şifre yenileme formunu gizle ve doğrulama formunu göster
    $('#resetPasswordForm').hide();
    $('#forgotPasswordForm').show();

    // Tüm input alanlarını sıfırla
    $('#forgotPasswordForm')[0].reset();
    $('#resetPasswordForm')[0].reset();

    // Hata mesajlarını temizle
    $('#forgotPasswordError').text('');
    $('#resetPasswordError').text('');
});

// Şifreyi Güncelleme Form İşleme
$('#resetPasswordForm').on('submit', function (e) {
    e.preventDefault();
    if ($('#newPassword').val() !== $('#confirmPassword').val()) {
        $('#resetPasswordError').text('Şifreler uyuşmuyor.');
        return;
    }

    $.ajax({
        url: 'reset_password.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            if (response.status === 'success') {
                alert('Şifre başarıyla güncellendi.');
                $('#forgotPasswordModal').modal('hide');
                $('#forgotPasswordForm')[0].reset();
                $('#resetPasswordForm')[0].reset();
                $('#resetPasswordForm').hide();
                $('#forgotPasswordForm').show();
            } else {
                $('#resetPasswordError').text(response.message || 'Şifre güncellenemedi.');
            }
        },
        error: function () {
            $('#resetPasswordError').text('Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    });
});


</script>
</body>
</html>
