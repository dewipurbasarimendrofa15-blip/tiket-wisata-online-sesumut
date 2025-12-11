<div class="auth-container">
    <div class="auth-card">
        <h2>Login ke Pariwisata Sumut</h2>
        <p class="subtitle">Masuk untuk melanjutkan pemesanan dan jelajahi wisata terbaik!</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/auth/login" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="Masukkan email anda">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn-primary">Login</button>

            <p class="register-link">
                Belum punya akun? <a href="<?= BASE_URL ?>/auth/register">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>

<style>
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(135deg, #0099ff, #0052cc);
}

.auth-card {
    width: 420px;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

.auth-card h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #0052cc;
}

.subtitle {
    text-align: center;
    margin-bottom: 20px;
    color: #666;
}

.form-group {
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.btn-primary {
    width: 100%;
    padding: 12px;
    background: #0052cc;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-primary:hover {
    background: #003d99;
}

.register-link {
    text-align: center;
    margin-top: 15px;
}
</style>
