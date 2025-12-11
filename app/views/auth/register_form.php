<h2 class="text-center mb-4">Daftar Akun</h2>

<form action="<?= BASE_URL ?>/auth/registerProcess" method="POST">
    
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
    </div>

    <button type="submit" class="btn btn-custom w-100 mt-3">Daftar</button>

    <p class="text-center mt-3">Sudah punya akun?
        <a href="<?= BASE_URL ?>/auth/login">Masuk Sekarang</a>
    </p>

</form>
