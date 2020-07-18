<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Guru</title>

    <!-- Load File bootstrap.min.css yang ada difolder css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .align-middle{
      vertical-align: middle !important;
    }
    </style>
  </head>
  <body>
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color: white;"><b>Manage Data guru</b></a>
        </div>
        <p class="navbar-text navbar-right hidden-xs">
          <a href="../index.php" style="color: white;" class="btn btn-primary">Kembali
          <span class="glyphicon glyphicon-download-alt"></span>
          </a>
        </p>
      </div>
    </nav>
    
    <div style="padding: 0 15px;">
      <button type="button" id="btn-tambah" data-toggle="modal" data-target="#form-modal" class="btn btn-success pull-right">
        <span class="glyphicon glyphicon-plus"></span>  Tambah Data
      </button>
      <h2>Data Guru</h2>	
      
      <div id="pesan-sukses" class="alert alert-success"></div>
      
      <!--
      -- Buat sebuah div dengan id="view" yang digunakan untuk menampung data 
      -- yang ada pada tabel siswa di database
      -->
      <div id="view"><?php include "../dataguru/view.php"; ?></div>
    </div>
    
    <!-- 
    -- Membuat sebuah tag div untuk Modal Dialog untuk Form Tambah dan Ubah
    -- Beri id "form-modal" untuk tag div tersebut
    -->
    <div id="form-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <!-- Beri id "modal-title" untuk tag span pada judul modal -->
              <span id="modal-title"></span>
            </h4>
          </div>
          <div class="modal-body">
            <!-- Beri id "pesan-error" untuk menampung pesan error -->
            <div id="pesan-error" class="alert alert-danger"></div>
            
            <!-- Beri id "form" untuk tag form -->
            <form id="form">
              <!-- 
              -- Beri id untuk masing-masing form input
              -- textbox nip : id="nip"
              -- textbox nama : id="nama"
              -- combobox jenis kelamin : id="jenis_kelamin"
              -- textbox no.telepon : id="telp"
              -- textarea alamat : id="alamat"
              -- checkbox foto : id="checkbox_foto"
              -- input file foto : id="foto"
              -->
              <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                  <option value="">Pilih</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" placeholder="No. Telepon">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <div id="checkbox_foto">
                  <input type="checkbox" id="ubah_foto" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto
                </div>
                <input type="file" class="form-control" id="foto">
              </div>
              <button type="reset" id="btn-reset"></button>
            </form>
          </div>
          <div class="modal-footer">
            <!-- Beri id "loading-simpan" untuk loading ketika klik tombol simpan -->
            <div id="loading-simpan" class="pull-left">
              <b>Sedang menyimpan...</b>
            </div>
            
            <!-- Beri id "loading-ubah" untuk loading ketika klik tombol ubah -->
            <div id="loading-ubah" class="pull-left">
              <b>Sedang mengubah...</b>
            </div>
            
            <!-- Beri id "btn-simpan" untuk tombol simpan nya -->
            <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
            
            <!-- Beri id "btn-ubah" untuk tombol simpan nya -->
            <button type="button" class="btn btn-primary" id="btn-ubah">Ubah</button>
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- 
    -- Membuat sebuah tag div untuk Modal Dialog untuk Form Tambah dan Ubah
    -- Beri id "form-modal" untuk tag div tersebut
    -->
    <div id="delete-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              Konfirmasi
            </h4>
          </div>
          <div class="modal-body">
            <!--
            -- Beri id "data-nis" untuk textbox nis yang digunakan untuk menampung
            -- data nis yang akan dihapus
            -->
            <input type="hidden" id="data-nis">
            
            Apakah anda yakin ingin menghapus data ini?
          </div>
          <div class="modal-footer">
            <!-- Beri id "loading-hapus" untuk loading ketika klik tombol hapus -->
            <div id="loading-hapus" class="pull-left">
              <b>Sedang meghapus...</b>
            </div>
            
            <!-- Beri id "btn-hapus" untuk tombol hapus nya -->
            <button type="button" class="btn btn-primary" id="btn-hapus">Ya</button>
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Load File jquery.min.js yang ada difolder js -->
    <script src="../assets/js/jquery.min.js"></script>
    
    <!-- Load File bootstrap.min.js yang ada difolder js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    
    <!-- Load file ajax.js yang ada di folder js -->
    <script src="../assets/js/ajaxguru.js"></script>
  </body>
</html>