<style>
body {
    background: linear-gradient(135deg, #1f4037, #99f2c8);
    font-family: 'Segoe UI', sans-serif;
}

.payment-box {
    max-width: 420px;
    background: #fff;
    margin: 100px auto;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.success-icon {
    font-size: 60px;
    color: #2ecc71;
    margin-bottom: 15px;
}

.total-box {
    margin: 20px 0;
    background: #ecf9f1;
    padding: 12px;
    border-radius: 12px;
    font-size: 22px;
    font-weight: bold;
}

.btn {
    display:block;
    margin-top:12px;
    padding:14px;
    border-radius:50px;
    text-decoration:none;
    color:white;
    font-weight:bold;
    transition:.3s ease;
}

.btn-ticket {
    background:linear-gradient(135deg,#3498db,#2980b9);
}

.btn-home {
    background:linear-gradient(135deg,#2ecc71,#27ae60);
}

.btn:hover {
    transform:translateY(-2px);
}
</style>

<div class="payment-box">
    <div class="success-icon">✅</div>

    <h2>Pembayaran Berhasil!</h2>
    <p><?= $message ?></p>

    <div class="total-box">
        Total: Rp <?= number_format($total) ?>
    </div>

    <?php if (!empty($booking_id)): ?>
        <a class="btn btn-ticket" href="<?= BASE_URL ?>/ticket/show/<?= $booking_id ?>">
            🎫 Lihat Tiket Wisata
        </a>
    <?php endif; ?>

    <a class="btn btn-home" href="<?= BASE_URL ?>/home">
        Kembali ke Beranda
    </a>
</div>
