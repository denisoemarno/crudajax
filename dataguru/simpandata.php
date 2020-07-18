<?php
// Include / load file koneksi.php
include "../conf/koneksi.php";

// Ambil data yang dikirim dari form
$nip = $_POST['nip']; // Ambil data nis dan masukkan ke variabel nis
$nama = $_POST['nama']; // Ambil data nama dan masukkan ke variabel nama
$jenis_kelamin = $_POST['jenis_kelamin']; // Ambil data jenis_kelamin dan masukkan ke variabel jenis_kelamin
$telp = $_POST['telp']; // Ambil data telp dan masukkan ke variabel telp
$alamat = $_POST['alamat']; // Ambil data alamat dan masukkan ke variabel alamat
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;

// Set path folder tempat menyimpan fotonya
$path = "../fotoguru/".$fotobaru;

// Proses upload
// Cek apakah gambar berhasil diupload atau tidak
if(move_uploaded_file($tmp, $path)){ // Jika proses upload sukses
  // Proses simpan ke Database
  $sql = $pdo->prepare("INSERT INTO guru VALUES(:nip,:nama,:jk,:telp,:alamat,:foto)");
  $sql->bindParam(':nip', $nip);
  $sql->bindParam(':nama', $nama);
  $sql->bindParam(':jk', $jenis_kelamin);
  $sql->bindParam(':telp', $telp);
  $sql->bindParam(':alamat', $alamat);
  $sql->bindParam(':foto', $fotobaru);
  $sql->execute(); // Eksekusi query insert
  
  // Load ulang view.php agar data yang baru bisa muncul di tabel pada view.php
  ob_start();
  include "../dataguru/view.php";
  $html = ob_get_contents();
  ob_end_clean();
  
  // Buat variabel reponse yang nantinya akan diambil pada proses ajax ketika sukses
  $response = array(
    'status'=>'sukses', // Set status
    'pesan'=>'Data berhasil disimpan', // Set pesan
    'html'=>$html // Set html
  );
}else{ // Jika proses upload gagal
  $response = array(
    'status'=>'gagal', // Set status
    'pesan'=>'Gambar gagal untuk diupload', // Set pesan
  );
}

echo json_encode($response); // konversi variabel response menjadi JSON
?>