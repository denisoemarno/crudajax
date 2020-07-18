<?php
// Load file koneksi.php
include "../conf/koneksi.php";

// Ambil data NIS
$nis = $_POST['nip'];

$sqlcek = $pdo->prepare("SELECT * FROM guru WHERE nip=:nip");
$sqlcek->bindParam(':nip', $nip);
$sqlcek->execute(); // Eksekusi / Jalankan query
$data = $sqlcek->fetch(); // Ambil data dari hasil eksekusi $sqlcek

// Cek apakah file fotonya ada di folder foto
if(is_file("../fotoguru/".$data['foto'])) // Jika foto ada
  unlink("../fotoguru/".$data['foto']); // Hapus file fotonya yang ada di folder foto

// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$sql = $pdo->prepare("DELETE FROM guru WHERE nip=:nip");
$sql->bindParam(':nip', $nip);
$sql->execute(); // Eksekusi/Jalankan query

// Load ulang view.php agar data diubah tadi bisa terubah di tabel pada view.php
ob_start();
include "view.php";
$html = ob_get_contents();
ob_end_clean();

// Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
$response = array(
  'pesan'=>'Data berhasil dihapus', // Set pesan
  'html'=>$html // Set html
);
echo json_encode($response); // konversi variabel response menjadi JSON
?>