<div class="col mt-3">
<h1>Selamat Datang Di Aplikasi Donasi Panti.</h1>
<h1>Anda Login Sebagai Panti</h1> 

    <div class="card">
      <img src="<?= base_url("uploads/panti/images.png")?>" style="width: 20%" class="card-img-top">
        <div class="card-body">
        <?php
                    foreach ($totkasus as $row){  
                    ?>
          <h5 class="card-title font-weight-bold"><?= $row['jmlkasus']?></h5>
                    <?php } ?>
          <p class="card-text">Jumlah Kasus</p>
          <a href="<?= base_url('panti/listKasusPanti') ?>" class="btn btn-primary">Lihat</a>
    </div>
 
    
        <br><br><br>
<div>
<?php echo $this->session->flashdata('pesan')?>
</div>
                  
</div>