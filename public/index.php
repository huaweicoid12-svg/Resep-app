<?php
// Website resep sederhana, tanpa database. Data resep ada di array di bawah ini.
$judul = "Dapur Nusantara";
$nama  = "Nama Kamu";
$nim   = "0000000000";

$resep = [
  [
    "nama"    => "Nasi Goreng Kampung",
    "waktu"   => "20 menit",
    "porsi"   => "2 porsi",
    "level"   => "Mudah",
    "intro"   => "Nasi sisa semalam jadi makan malam yang wangi dan pedas.",
    "bahan"   => ["3 piring nasi putih dingin", "3 siung bawang putih, cincang", "4 siung bawang merah, iris tipis",
                  "3 cabai rawit, iris", "2 butir telur", "2 sdm kecap manis", "1 sdm saus tiram", "Garam dan merica secukupnya", "Minyak untuk menumis"],
    "langkah" => ["Panaskan minyak, tumis bawang putih dan bawang merah sampai harum.",
                  "Masukkan cabai, lalu geser bumbu ke pinggir wajan dan orak-arik telur di sisi kosong.",
                  "Tambahkan nasi, aduk rata dengan telur dan bumbu.",
                  "Tuang kecap manis dan saus tiram, beri garam dan merica.",
                  "Aduk di api besar 2-3 menit sampai nasi kering dan sedikit gosong di tepi. Sajikan hangat."],
  ],
  [
    "nama"    => "Soto Ayam Bening",
    "waktu"   => "60 menit",
    "porsi"   => "4 porsi",
    "level"   => "Sedang",
    "intro"   => "Kuah kuning yang bening dan segar, cocok untuk hari hujan.",
    "bahan"   => ["500 g ayam, potong beberapa bagian", "2 liter air", "2 batang serai, memarkan", "3 lembar daun jeruk",
                  "1 ruas lengkuas, memarkan", "5 siung bawang putih", "6 siung bawang merah", "2 cm kunyit", "1 sdt merica butir",
                  "Soun, tauge, dan telur rebus untuk pelengkap", "Bawang goreng dan seledri untuk taburan"],
    "langkah" => ["Rebus ayam dalam air sampai mendidih, buang busa yang muncul di permukaan.",
                  "Haluskan bawang putih, bawang merah, kunyit, dan merica, lalu tumis sampai harum.",
                  "Masukkan bumbu tumis, serai, daun jeruk, dan lengkuas ke dalam kaldu.",
                  "Masak dengan api kecil 40 menit sampai ayam empuk. Angkat ayam, suwir dagingnya.",
                  "Tata soun, tauge, suwiran ayam, dan telur di mangkuk. Siram kuah panas, taburi bawang goreng dan seledri."],
  ],
  [
    "nama"    => "Tempe Orek Manis Pedas",
    "waktu"   => "25 menit",
    "porsi"   => "3 porsi",
    "level"   => "Mudah",
    "intro"   => "Lauk tahan lama yang enak dimakan dengan nasi hangat.",
    "bahan"   => ["300 g tempe, potong dadu kecil", "4 siung bawang merah, iris", "2 siung bawang putih, iris",
                  "5 cabai merah, iris serong", "3 sdm kecap manis", "1 sdt gula merah serut", "Garam secukupnya", "Minyak untuk menggoreng dan menumis"],
    "langkah" => ["Goreng tempe sampai kuning keemasan, tiriskan.",
                  "Tumis bawang merah, bawang putih, dan cabai sampai layu.",
                  "Masukkan tempe goreng, kecap manis, gula merah, dan garam.",
                  "Aduk dengan api kecil sampai bumbu meresap dan agak kering."],
  ],
  [
    "nama"    => "Es Teh Jeruk Nipis",
    "waktu"   => "5 menit",
    "porsi"   => "2 gelas",
    "level"   => "Mudah",
    "intro"   => "Minuman penutup yang cuma butuh tiga bahan.",
    "bahan"   => ["2 kantong teh celup", "400 ml air panas", "2 sdm gula pasir", "Perasan 1 jeruk nipis", "Es batu"],
    "langkah" => ["Seduh teh dengan air panas selama 3 menit, lalu angkat kantong tehnya.",
                  "Larutkan gula dalam teh selagi masih hangat.",
                  "Tambahkan perasan jeruk nipis.",
                  "Tuang ke gelas berisi es batu dan sajikan."],
  ],
];

function e($teks) { return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($judul) ?> - Kumpulan Resep</title>
<style>
  :root { --bg: #F2F6F2; --card: #FFFFFF; --ink: #1B2B22; --muted: #52645A; --line: #D3DDD5; --teal: #0F766E; --kunyit: #E8B100; }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { background: var(--bg); color: var(--ink); font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
         font-size: 17px; line-height: 1.6; }
  .wrap { max-width: 960px; margin: 0 auto; padding: 0 24px; }
  a:focus-visible, summary:focus-visible { outline: 3px solid var(--teal); outline-offset: 3px; }

  header { padding: 64px 0 40px; border-bottom: 4px solid var(--kunyit); }
  header h1 { font-size: clamp(2.4rem, 7vw, 4.2rem); line-height: 1.05; letter-spacing: -0.02em; }
  header p { margin-top: 16px; color: var(--muted); max-width: 50ch; font-size: 1.1rem; }

  .daftar { padding: 40px 0 56px; display: grid; gap: 20px; }
  details { background: var(--card); border: 1px solid var(--line); border-radius: 10px; }
  summary { list-style: none; cursor: pointer; padding: 22px 24px; display: flex; justify-content: space-between;
            align-items: center; gap: 16px; flex-wrap: wrap; }
  summary::-webkit-details-marker { display: none; }
  summary h2 { font-size: 1.5rem; line-height: 1.2; }
  summary .intro { color: var(--muted); font-size: 0.98rem; flex-basis: 100%; }
  .meta { display: flex; gap: 8px; flex-wrap: wrap; }
  .meta span { background: var(--bg); border: 1px solid var(--line); border-radius: 999px; padding: 2px 12px; font-size: 0.88rem; }
  summary::after { content: "Buka resep"; color: var(--teal); font-weight: 600; font-size: 0.95rem; margin-left: auto; }
  details[open] summary::after { content: "Tutup"; }
  details[open] summary { border-bottom: 1px solid var(--line); }

  .isi { padding: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 32px; }
  .isi h3 { font-size: 1.1rem; margin-bottom: 10px; }
  .isi ul, .isi ol { padding-left: 22px; }
  .isi li { margin-bottom: 6px; }
  .isi li::marker { color: var(--teal); font-weight: 700; }

  footer { border-top: 1px solid var(--line); padding: 28px 0 48px; color: var(--muted); font-size: 0.95rem; }

  @media (prefers-color-scheme: dark) {
    :root { --bg: #0F1A14; --card: #16241C; --ink: #E7F0E9; --muted: #9DB3A5; --line: #2A3D31; --teal: #4FD1C5; }
  }
</style>
</head>
<body>

<header>
  <div class="wrap">
    <h1><?= e($judul) ?></h1>
    <p>Kumpulan resep rumahan yang gampang dibuat. Klik salah satu resep untuk melihat bahan dan langkahnya.</p>
  </div>
</header>

<main class="wrap">
  <div class="daftar">
    <?php foreach ($resep as $r): ?>
      <details>
        <summary>
          <h2><?= e($r["nama"]) ?></h2>
          <div class="meta">
            <span><?= e($r["waktu"]) ?></span>
            <span><?= e($r["porsi"]) ?></span>
            <span><?= e($r["level"]) ?></span>
          </div>
          <p class="intro"><?= e($r["intro"]) ?></p>
        </summary>
        <div class="isi">
          <section>
            <h3>Bahan</h3>
            <ul>
              <?php foreach ($r["bahan"] as $b): ?><li><?= e($b) ?></li><?php endforeach; ?>
            </ul>
          </section>
          <section>
            <h3>Langkah</h3>
            <ol>
              <?php foreach ($r["langkah"] as $l): ?><li><?= e($l) ?></li><?php endforeach; ?>
            </ol>
          </section>
        </div>
      </details>
    <?php endforeach; ?>
  </div>
</main>

<footer>
  <div class="wrap">
    <?= e($nama) ?>, NIM <?= e($nim) ?>. Dijalankan di Azure App Service dengan PHP <?= PHP_VERSION ?>.
  </div>
</footer>

</body>
</html>