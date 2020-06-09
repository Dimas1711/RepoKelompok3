<div class="well well-lg">
    <div class="container">
        <h2> Profil</h2>
      <div class="row">
        <div class="col-lg-6">
        <?= $this->session->flashdata('pesan') ?>  
        </div>

      </div>

    <div class="row row-cols-1 row-cols-md-2">
  <div class="col lg-8">

    <div class="card">
    <center>
      <img src="<?= base_url('uploads/akun/') . $registrasi['profil'];?>" class="card-img-top"alt="profil" style="width:300" >
    </center>
      <div class="card-body">
      <div class="row">
          <div class="my-auto col-sm-2">
            <p>Ketua Panti : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $registrasi['nama']?></p>
          </div>
        </div>

      <div class="row">
          <div class="my-auto col-sm-2">
            <p>Email : </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $registrasi['email']?></p>
          </div>
        </div>
        
                    <a href="<?php echo base_url("panti/editdataakun/".$registrasi['id_registrasi']);?>"
                             class="btn btn-primary">Edit Profil
                        </a>
      </div>
    </div>
  </div>

      </div>
    </div>
  </div>
</div>
</div>

</div>