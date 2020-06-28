<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="" method="post">
        

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Panti</h1>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button class="btn btn-sm btn-info btn-icon-split shadow-sm" type="submit" name="setuju" id="setuju">
              <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Setujui</span></button>
              
              <button class="btn btn-sm btn-danger btn-icon-split shadow-sm" type="submit" name="tolak" id="tolak">
              <span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Tolak</span></button>
            </div>
          <div class="card shadow mb-4">
          <?php foreach ($panti as $row) {
          ?>
          <input type="hidden" name="id_panti" value="<?= $row['id_panti']?>">
          <input type="hidden" name="id_regis" value="<?= $row['id_registrasi']?>">
            <div class="card-body">
              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_panti'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama Ketua Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_yayasanInduk'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nomor KTP Ketua Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['no_ktp'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Foto KTP Ketua Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                   <p><a href="<?= base_url('uploads/panti/'). $row['ktp_pemilik']?>">Download File</a></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Alamat Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['alamat_panti'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Kabupaten</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_kabupaten'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Provinsi</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_provinsi'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>No Telp</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['no_telp'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Email Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['email'] ?></p>
                  <input type="hidden"id="email" name="email" value="<?= $row['email']?>">
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Deskripsi Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['deskripsi'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Tanggal Berdiri Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['tanggal_berdiri'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Logo Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                  <img src="<?=base_url('uploads/panti/') . $row['foto'] ?>" alt="foto" width="50">
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Surat Pengesahan Panti</p>
                </div>
                <div class="my-auto col-sm-9">
                <p><a href="<?= base_url('uploads/panti/'). $row['surat_pengesahan']?>">Download File</a></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama Rekening</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_rekening'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama Bank</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_bank'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nomer Rekening</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['no_rekening'] ?></p>
                </div>
              </div>
              
            
          <?php }?>

              <a href="<?php echo base_url('admin/verifikasi_panti') ?>" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-reply"></i>
                </span>
                <span class="text">Kembali</span>
              </a>
            </div>
          </div>
          <!-- /.card -->
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
  <!-- End of Page Wrapper -->