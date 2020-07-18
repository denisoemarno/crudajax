<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th class="text-center">NO</th>
      <th class="text-center">FOTO</th>
      <th>NIP</th>
      <th>NAMA</th>
      <th>JENIS KELAMIN</th>
      <th>TELP</th>
      <th>ALAMAT</th>
      <th colspan="2" class="text-center"><span class="glyphicon glyphicon-cog"></span></th>
    </tr>
    <?php
    // Include / load file koneksi.php
    include "../conf/koneksi.php";
    
    // Buat query untuk menampilkan semua data siswa
    $sql = $pdo->prepare("SELECT * FROM guru");
    $sql->execute(); // Eksekusi querynya
    
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    ?>
      <tr>
        <td class="align-middle text-center"><?php echo $no; ?></td>
        <td class="align-middle text-center">
          <img src="../fotoguru/<?php echo $data['foto']; ?>" width="120" height="150px">
        </td>
        <td class="align-middle"><?php echo $data['nip']; ?></td>
        <td class="align-middle"><?php echo $data['nama']; ?></td>
        <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
        <td class="align-middle"><?php echo $data['telp']; ?></td>
        <td class="align-middle"><?php echo $data['alamat']; ?></td>
        <td class="align-middle text-center">
          <a href="javascript:void();" data-toggle="modal" data-target="#form-modal" onclick="edit(<?php echo $no; ?>);" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
        </td>
        <td class="align-middle text-center">
          <a href="javascript:void();" data-toggle="modal" data-target="#delete-modal" onclick="hapus(<?php echo $no; ?>);" class="btn btn-danger"><span class="glyphicon glyphicon-erase"></span></a>
        </td>
      </tr>
      <!--
      -- Membuat sebuah textbox hidden yang akan digunakan untuk form ubah
      -->
      <input type="hidden" id="nip-value-<?php echo $no; ?>" value="<?php echo $data['nip']; ?>">
      <input type="hidden" id="nama-value-<?php echo $no; ?>" value="<?php echo $data['nama']; ?>">
      <input type="hidden" id="jeniskelamin-value-<?php echo $no; ?>" value="<?php echo $data['jenis_kelamin']; ?>">
      <input type="hidden" id="telp-value-<?php echo $no; ?>" value="<?php echo $data['telp']; ?>">
      <input type="hidden" id="alamat-value-<?php echo $no; ?>" value="<?php echo $data['alamat']; ?>">
    <?php
      $no++; // Tambah 1 setiap kali looping
    }
    ?>
  </table>
</div>

<script>
// Fungsi ini akan dipanggil ketika tombol edit diklik
function edit(no){
  $("#btn-simpan").hide(); // Sembunyikan tombol simpan
  $("#btn-ubah, #checkbox_foto").show(); // Munculkan tombol ubah dan checkbox foto
  
  // Set judul modal dialog menjadi Form Ubah Data
  $("#modal-title").html("Form Ubah data");
  
  var nis = $("#nip-value-" + no).val(); // Ambil nis dari input type hidden
  var nama = $("#nama-value-" + no).val(); // Ambil nama dari input type hidden
  var jeniskelamin = $("#jeniskelamin-value-" + no).val(); // Ambil jenis kelamin dari input type hidden
  var telp = $("#telp-value-" + no).val(); // Ambil telp dari input type hidden
  var alamat = $("#alamat-value-" + no).val(); // Ambil alamat dari input type hidden
  
  // Set value dari textbox nis yang ada di form
  // Set textbox nis menjadi Readonly
  $("#nip").val(nip).attr("readonly","readonly");
  
  $("#nama").val(nama); // Set value dari textbox nama yang ada di form
  $("#jenis_kelamin").val(jeniskelamin); // Set value dari textbox nama yang ada di form
  $("#telp").val(telp); // Set value dari textbox nama yang ada di form
  $("#alamat").val(alamat); // Set value dari textbox nama yang ada di form
  $("#foto").val("");
}

// Fungsi ini akan dipanggil ketika tombol hapus diklik
function hapus(no){
  var nis = $("#nip-value-" + no).val(); // Ambil nis dari input type hidden
  
  // Set textbox hidden nis yang ada di modal dialog hapus
  $("#data-nip").val(nis);
}
</script>