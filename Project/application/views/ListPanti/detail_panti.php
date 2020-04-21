<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Panti</h1>
    <?php foreach ($listpanti as $a):?>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
      </div>
      <div class="card-body">

        <img src="<?= base_url('uploads/listpanti/') . $a['gambar'];?>" alt="Logo Komunitas" class="logo-komunitas mx-auto d-block mb-5" style="width:300">

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Panti : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['nama_panti']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>No Telpon : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['no_telp']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Yayasan : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['nama_yayasanInduk']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Tanggal Berdiri : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['tanggal_berdiri']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Alamat Panti : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['alamat_panti']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Rekening : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['nama_rekening']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>No Rekening : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['no_rekening']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Bank : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['nama_bank']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Email : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $a['email']?></p>
          </div>
        </div>

        <?php endforeach ;?>
        <a href="<?php echo base_url('tampilPanti') ?>" class="btn btn-danger btn-icon-split">
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