<div class="col mt-3">
<?php if ($registrasi['status'] == 0){?>
  <h1>Selamat Datang Di Aplikasi Donasi Panti.</h1>
<?php } else { ?>
    <h1>Selamat Datang Di Aplikasi Donasi Panti.</h1>
    <h1>Anda Login Sebagai Panti</h1> 
    <?php echo $this->session->flashdata('pesan')?>
    <div class="card">
      <img src="<?= base_url("uploads/panti/images.png")?>" style="width: 20%" class="card-img-top">
        <div class="card-body">
        <?php foreach ($totkasus as $row){  ?>
          <h5 class="card-title font-weight-bold"><?= $row['jmlkasus']?></h5>
        <?php } ?>
          <p class="card-text">Jumlah Kasus</p>
          <a href="<?= base_url('panti/listKasusPanti') ?>" class="btn btn-primary">Lihat</a>
    </div>
 
<?php } ?>

    
    <br><br><br>
<div>

</div>
                  
</div>