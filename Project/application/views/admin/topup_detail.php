<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="" method="post">
        

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Top Up Donatur</h1>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button class="btn btn-sm btn-info btn-icon-split shadow-sm" type="submit" name="setuju" id="setuju">
              <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Setujui</span></button>
              
              <button class="btn btn-sm btn-danger btn-icon-split shadow-sm" type="submit" name="tolak" id="tolak">
              <span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Tolak</span></button>
            </div>
          <div class="card shadow mb-4">
          <?php foreach ($dompet as $row) {
          ?>
          <input type="hidden" name="id_dompet" value="<?= $row['id_dompet']?>">
          <input type="hidden" name="finansial" value="<?= $row['finansial']?>">
          <input type="hidden" name="id_user" value="<?= $row['id_user']?>">
          <input type="hidden" name="jumlah_inginkan" value="<?= $row['jumlah_inginkan']?>">
            <div class="card-body">
              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama_user'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Finansial</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['finansial'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Jumlah Top up</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['jumlah_inginkan'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Foto</p>
                </div>
                <div class="my-auto col-sm-9">
                  <img src="<?= base_url('uploads/topup/') . $row['foto'] ?>" alt="fotoe" width="150">
                </div>
              </div>  
          <?php }?>

              <a href="<?php echo base_url('admin/verif_topup') ?>" class="btn btn-danger btn-icon-split">
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