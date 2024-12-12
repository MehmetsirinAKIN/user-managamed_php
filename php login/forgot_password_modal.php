
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Şifremi Unuttum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">E-posta Adresiniz</label>
                        <input type="email" class="form-control" id="resetEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="resetPhone" class="form-label">Telefon Numaranız</label>
                        <input type="text" class="form-control" id="resetPhone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Doğrula ve Şifre Sıfırla</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).on('submit', '#forgotPasswordForm', function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    $.ajax({
        url: 'reset_password.php',
        type: 'POST',
        data: formData,
        success: function (response) {
            console.log(response); // Gelen cevabı konsolda göster
            const result = JSON.parse(response);

            if (result.status === 'success' && result.message.includes('Kullanıcı doğrulandı')) {
                // Şifre sıfırlama formunu göster
                $('#forgotPasswordForm').html(`
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Yeni Şifreniz</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Şifreyi Güncelle</button>
                `);
            } else if (result.status === 'success') {
                alert(result.message);
                $('#forgotPasswordModal').modal('hide');
                $('#forgotPasswordForm')[0].reset();
            } else {
                alert(result.message);
            }
        },
        error: function () {
            alert('Bir hata oluştu.');
        }
    });
});

</script>
