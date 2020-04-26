<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <form action="" method="post">
        

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detail Admin</h1>
          <div class="card shadow mb-4">
            
          <div class="card shadow mb-4">
          <?php foreach ($admin as $row) {
          ?>
            <div class="card-body">
              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Nama Admin</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['nama'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Level</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['level'] ?></p>
                </div>
              </div>

              <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Tanggal Bergabung</p>
                </div>
                <div class="my-auto col-sm-9">
                  <p><?= $row['tanggal_bergabung'] ?></p>
                </div>
              </div>


            
          <?php }?>

              <a href="<?php echo base_url('admin/settingakun') ?>" class="btn btn-danger btn-icon-split">
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