<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="" method="post">
        

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Kasus Donasi</h1>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button class="btn btn-sm btn-info btn-icon-split shadow-sm" type="submit" name="setuju" id="setuju">
              <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Setujui</span></button>
              
              <button class="btn btn-sm btn-danger btn-icon-split shadow-sm" type="submit" name="tolak" id="tolak">
              <span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Tolak</span></button>
            </div>
          <div class="card shadow mb-4">
          <?php foreach ($kasus as $row) {
          ?>
          <input type="hidden" name="id_kasus" value="<?= $row['id_kasus']?>">
          <input type="hidden" id="email" name="email" value="<?= $row['email']?>">
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
                  <p>Judul</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['judul'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Kategori</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['kategori'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Tujuan Dana</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['tujuan_dana'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Tanggal</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['tanggal'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Tenggat Waktu</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['tenggat_waktu'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Jumlah Pendonasi</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['jumlah_pendonasi'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Jumlah Uang Terkumpul</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['jumlah_uang_terkumpul'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Deskripsi</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['deskripsi'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Foto</p>
                </div>
                <div class="my-auto col-sm-9">
                  <img src="<?=base_url('uploads/panti/') . $row['gambar'] ?>" alt="fotoe" width="150">
                </div>
              </div>  
          <?php }?>

              <a href="<?php echo base_url('admin/verif_kasus') ?>" class="btn btn-danger btn-icon-split">
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