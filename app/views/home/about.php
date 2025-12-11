<style>
/* CSS hanya untuk About */
.about-page{
  background:#f4f6fb;
}
.about-hero{
  height:70vh;
  background:linear-gradient(135deg,#002f6c,#0066ff);
  border-radius:0 0 40px 40px;
  display:flex;
  justify-content:center;
  align-items:center;
  color:white;
  text-align:center;
  margin-bottom:60px;
}
.about-hero h1{font-size:48px}
.about-hero p{font-size:18px;margin-top:10px}

.about-container{
  max-width:1100px;
  margin:auto;
  padding:0 20px 80px;
}

.about-card{
  background:white;
  padding:40px;
  border-radius:25px;
  box-shadow:0 20px 50px rgba(0,0,0,.08);
  margin-bottom:50px;
  text-align:center;
}

.about-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
}

.about-box{
  background:white;
  padding:30px;
  border-radius:25px;
  box-shadow:0 20px 50px rgba(0,0,0,.1);
  transition:.2s ease;
  text-align:center;
}
.about-box:hover{transform:translateY(-10px)}

.team-title{
  text-align:center;
  font-size:36px;
  margin:60px 0 40px;
}

.team-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:25px;
}

.team-card{
  background:white;
  padding:22px;
  border-radius:25px;
  box-shadow:0 20px 50px rgba(0,0,0,.1);
  text-align:center;
  transition:.2s ease;
}
.team-card:hover{transform:translateY(-15px)}

.team-card img{
  width:100%;
  height:230px;
  border-radius:20px;
  object-fit:cover;
  margin-bottom:12px;
}
</style>
<div class="about-page">

  <div class="about-hero">
    <div>
      <h1>About Us</h1>
      <p>Platform wisata Sumatera Utara modern dan profesional</p>
    </div>
  </div>

  <div class="about-container">

    <div class="about-card">
      <h2>Siapa Kami?</h2>
      <p>
        Kami adalah tim kreatif yang mengembangkan platform Pariwisata Sumatera Utara
        untuk memberikan pengalaman wisata digital yang nyaman dan modern.
      </p>
    </div>

    <div class="about-grid">
      <div class="about-box">
        <h3>🚀 Visi</h3>
        <p>Menjadi platform wisata digital terpercaya.</p>
      </div>
      <div class="about-box">
        <h3>🎯 Misi</h3>
        <p>Menyediakan info wisata lengkap dan mudah dipakai.</p>
      </div>
      <div class="about-box">
        <h3>💎 Nilai</h3>
        <p>Mengutamakan pengalaman pengguna premium.</p>
      </div>
    </div>

    <h2 class="team-title">Tim Kami</h2>

    <div class="team-grid">

      <div class="team-card">
        <img src="<?php echo BASE_URL; ?>/public/uploads/team1.jpg">
        <h4>Dewi Purbasari Mendrofa</h4>
        <span>Founder</span>
      </div>

      <div class="team-card">
        <img src="<?php echo BASE_URL; ?>/public/uploads/team2.jpg">
        <h4>Rina Prudencia Siregar</h4>
        <span>Developer</span>
      </div>

      <div class="team-card">
        <img src="<?php echo BASE_URL; ?>/public/uploads/team3.jpg">
        <h4>Lasma Puja Simbolon</h4>
        <span>Designer</span>
      </div>

    </div>

  </div>

</div>
