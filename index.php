<?php
$conn = new mysqli("localhost", "root", "", "homemade_delight");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$total_bayar = 0;
$status_pesanan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $telepon = $_POST['telepon'];
  $alamat = $_POST['alamat'];
  $mode = $_POST['transaksiMode'];
  $rakik = (int)$_POST['rakik'];
  $balado = (int)$_POST['balado'];
  $jangek = (int)$_POST['jangek'];
  $sanjai = (int)$_POST['sanjai'];
  $karak = (int)$_POST['karak'];

  $total_bayar = ($rakik * 10000) + ($balado * 12000) + ($jangek * 20000) + ($sanjai * 13000) + ($karak * 15000);

  $sql = "INSERT INTO pesanan (nama, telepon, alamat, mode, rakik, balado, jangek, sanjai, karak, total)
          VALUES ('$nama', '$telepon', '$alamat', '$mode', $rakik, $balado, $jangek, $sanjai, $karak, $total_bayar)";

  if ($conn->query($sql) === TRUE) {
    $status_pesanan = "✅ Pesanan berhasil disimpan.";
  } else {
    $status_pesanan = "❌ Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Homemade Delight</title>
  <style>
    body { font-family: Arial; background: #fff8e1; color: #4e342e; }
    .container { max-width: 700px; margin: 0 auto; padding: 20px; background: #fff3e0; border-radius: 10px; }
    h1 { text-align: center; color: #e65100; }
    label { display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
    button { margin-top: 15px; padding: 10px; background: #ffb300; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    .total { font-weight: bold; background: #ffe082; padding: 10px; margin-top: 10px; border-radius: 5px; }
    .success { color: green; margin-top: 10px; }
    .error { color: red; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Homemade Delight - Pemesanan</h1>
    <form method="POST">
      <label>Nama:</label>
      <input type="text" name="nama" required>

      <label>Telepon:</label>
      <input type="text" name="telepon" required>

      <label>Alamat:</label>
      <input type="text" name="alamat" required>

      <label>Mode Transaksi:</label>
      <select name="transaksiMode">
        <option value="COD">COD</option>
        <option value="Transfer">Transfer</option>
        <option value="QRIS">QRIS</option>
      </select>

      <label>Rakik (Rp10.000):</label>
      <input type="number" name="rakik" min="0" value="0">

      <label>Keripik Balado (Rp12.000):</label>
      <input type="number" name="balado" min="0" value="0">

      <label>Karupuak Jangek (Rp20.000):</label>
      <input type="number" name="jangek" min="0" value="0">

      <label>Keripik Sanjai (Rp13.000):</label>
      <input type="number" name="sanjai" min="0" value="0">

      <label>Karak Kaliang (Rp15.000):</label>
      <input type="number" name="karak" min="0" value="0">

      <button type="submit">Pesan</button>
    </form>

    <?php if ($status_pesanan): ?>
      <p class="<?= strpos($status_pesanan, 'berhasil') !== false ? 'success' : 'error' ?>"><?= $status_pesanan ?></p>
      <p class="total">Total Pembayaran: Rp<?= number_format($total_bayar, 0, ',', '.') ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
