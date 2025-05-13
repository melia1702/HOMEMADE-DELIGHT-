<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "homemade_db";

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$mode = $_POST['transaksiMode'];

$rakik = intval($_POST['rakik']);
$balado = intval($_POST['balado']);
$jangek = intval($_POST['jangek']);
$sanjai = intval($_POST['sanjai']);
$karak = intval($_POST['karak']);

$total = ($rakik * 10000) + ($balado * 12000) + ($jangek * 20000) + ($sanjai * 13000) + ($karak * 15000);

$sql = "INSERT INTO pesanan (nama, telepon, alamat, mode, rakik, balado, jangek, sanjai, karak, total)
VALUES ('$nama', '$telepon', '$alamat', '$mode', $rakik, $balado, $jangek, $sanjai, $karak, $total)";

if ($koneksi->query($sql) === TRUE) {
  echo "<h2>✅ Pesanan berhasil disimpan!</h2>";
  echo "<p><strong>Nama:</strong> $nama<br>";
  echo "<strong>Telepon:</strong> $telepon<br>";
  echo "<strong>Alamat:</strong> $alamat<br>";
  echo "<strong>Mode Transaksi:</strong> $mode</p>";

  echo "<h3>Rincian Pesanan:</h3>";
  echo "<ul>";
  if ($rakik > 0) echo "<li>Rakik: $rakik × Rp10.000 = Rp" . number_format($rakik * 10000, 0, ',', '.') . "</li>";
  if ($balado > 0) echo "<li>Keripik Balado: $balado × Rp12.000 = Rp" . number_format($balado * 12000, 0, ',', '.') . "</li>";
  if ($jangek > 0) echo "<li>Karupuak Jangek: $jangek × Rp20.000 = Rp" . number_format($jangek * 20000, 0, ',', '.') . "</li>";
  if ($sanjai > 0) echo "<li>Keripik Sanjai: $sanjai × Rp13.000 = Rp" . number_format($sanjai * 13000, 0, ',', '.') . "</li>";
  if ($karak > 0) echo "<li>Karak Kaliang: $karak × Rp15.000 = Rp" . number_format($karak * 15000, 0, ',', '.') . "</li>";
  echo "</ul>";

  echo "<h3>Total Bayar: <span style='color:green;'>Rp" . number_format($total, 0, ',', '.') . "</span></h3>";
  echo "<a href='index.html'>← Kembali</a>";
} else {
  echo "❌ Gagal menyimpan: " . $koneksi->error;
}

$koneksi->close();
?>
