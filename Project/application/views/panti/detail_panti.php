<div class="well well-lg">
    <div class="container">
        <h2> Edit Data Panti</h2>
      <div class="row">
        <div class="col-lg-6">
        <?= $this->session->flashdata('pesan') ?>  
        </div>

      </div>

    <div class="row row-cols-1 row-cols-md-2">
  <div class="col lg-8">
  <?php  foreach($datapanti as $akun){?>
    <div class="card">
      <div class="card-body">
      <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Panti  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['nama_panti']?></p>
          </div>
        </div>
  
        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nomor Telepon  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['no_telp']?></p>
          </div>
        </div>

      <div class="row">
          <div class="my-auto col-sm-2">
            <p>Email  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['email']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Ketua Panti  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['nama_yayasanInduk']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nomor KTP  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['no_ktp']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Alamat  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['alamat_panti']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Bank  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['nama_bank']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nomor Rekening  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['no_rekening']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nama Rekening  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['nama_rekening']?></p>
          </div>
        </div>

        <div class="row">
          <div class="my-auto col-sm-2">
            <p>Nomor KTP  </p>
          </div>
          <div class="my-auto col-sm-9">
            <p><?= $akun['no_ktp']?></p>
          </div>
        </div>
         
        <div class="row">
                <div class="my-auto col-sm-2">
                  <p>Foto KTP</p>
                </div>
                <div class="my-auto col-sm-9">
                  <img src="<?=base_url('uploads/panti/') . $akun['ktp_pemilik'] ?>" alt="foto" width="100">
                </div>
              </div>

        <?php } ?>
        
                    <a href="<?php echo base_url("panti/editdata/".$registrasi['id_registrasi']);?>"
                             class="btn btn-primary">Edit Data
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