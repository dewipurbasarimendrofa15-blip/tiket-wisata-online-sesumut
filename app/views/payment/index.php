<div class="payment-wrapper">

  <div class="payment-card">

    <h2>💳 Pembayaran</h2>
    <p class="payment-sub">Pilih metode pembayaran favoritmu</p>

    <div class="total-box">
      <span>Total Pembayaran</span>
      <h1>Rp <?= number_format($total) ?></h1>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/payment/process">

      <div class="pay-option">
        <input type="radio" name="metode" value="bca" id="bca" required>
        <label for="bca">
          <img src="<?= BASE_URL ?>/public/uploads/bca.png">
          <span>Bank BCA</span>
        </label>
      </div>

      <div class="pay-option">
        <input type="radio" name="metode" value="mandiri" id="mandiri">
        <label for="mandiri">
          <img src="<?= BASE_URL ?>/public/uploads/mandiri.png">
          <span>Bank Mandiri</span>
        </label>
      </div>

      <div class="pay-option">
        <input type="radio" name="metode" value="gopay" id="gopay">
        <label for="gopay">
          <img src="<?= BASE_URL ?>/public/uploads/gopay.png">
          <span>GoPay</span>
        </label>
      </div>

      <div class="pay-option">
        <input type="radio" name="metode" value="ovo" id="ovo">
        <label for="ovo">
          <img src="<?= BASE_URL ?>/public/uploads/ovo.png">
          <span>OVO</span>
        </label>
      </div>

      <button class="btn-pay-now">
        Bayar Sekarang
      </button>

    </form>

  </div>

</div>
