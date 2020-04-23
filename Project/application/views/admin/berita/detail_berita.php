<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Berita</h1>
    <?php foreach ($berita as $berita):?>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
      </div>
      <div class="card-body">

        <img src="<?= base_url('uploads/berita/') . $berita['gambar'];?>" alt="Logo Komunitas" class="logo-komunitas mx-auto d-block mb-5" style="width:300">

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Tanggal Berita : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $berita['tanggal_berita']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Judul  : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $berita['judul']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Isi : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $berita['isi']?></p>
          </div>
        </div>
        <?php endforeach ;?>
        <a href="<?php echo base_url('berita') ?>" class="btn btn-danger btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-reply"></i>
          </span>
          <span class="text">Kembali</span>
        </a>

      </div>
    </div>
    <!-- /.card -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


</div>