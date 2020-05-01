<div class="col mt-3">
<a href ="<?= base_url('tampilPanti/tambahpanti') ?>" class="nav-link" href="<?= base_url("panti/tambah_panti")?>"
class="btn btn-sm btn-info btn-icon-split shadow-sm">
                  <a href="<?= base_url('panti/tambahpanti') ?>"
                   class="btn btn-sm btn-info btn-icon-split shadow-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                  </span>
                  <span class="text">Daftar Panti</span>
</a> <br><br><br><br>

        <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <div class="text-box" >
                <img src="<?= base_url("uploads/panti/kasus.png")?>" width="120px">
                <br><br>
                    <p class="text-muted">Jumlah Kasus</p>
                    <!-- <p class="main-text"><?php //echo "$d";?></p>-->
                </div>
            </div>
		</div>

<div>
<?php echo $this->session->flashdata('pesan')?>
</div>
                  
</div>