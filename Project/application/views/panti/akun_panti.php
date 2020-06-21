<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Edit Profil</h1>
 <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">
  <?php  foreach($akun as $akun){?>
        <div class="form-group-row">
            <div class="col-sm-9">
                <p>Email</p>
                    <div class="input-group">
                        <input type="email"
                        id="email"
                        name="email"
                                class="form-control border-dark small mb-3"
                                value="<?= $akun['email']?>"
                                aria-describedby="basic-addon2" readonly>
                        </div>
                        <?= form_error('email', '<small class="text-danger">', '</small>')?> 
            </div>
        </div>
        <div class="form-group-row">
              <div class="col-sm-9">
                <p>Password</p>
                  <div class="input-group">
                    <input type="password"
                    id="password"
                    name="password"
                           class="form-control border-dark small mb-3"
                           value="<?= $akun['password']?>"
                           aria-describedby="basic-addon2" >
                  </div>
                  <?= form_error('password', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>
                <div class="form-group-row">
            <div class="col-sm-9">
                <p>Nama</p>
                    <div class="input-group">
                        <input type="text"
                        id="nama"
                        name="nama"
                                class="form-control border-dark small mb-3"
                                value="<?= $akun['nama']?>"
                                aria-describedby="basic-addon2">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>')?> 
            </div>
        </div>
                <div class="form-group-row">
              <div class="col-sm-9">
                <p>Foto Profil</p>
                  <div class="input-group">
                    <input type="file"
                    id="profil"
                    name="profil"
                           class="form-control border-dark small mb-3"
                           value="<?php echo set_value('profil')?>"
                           aria-describedby="basic-addon2">
                  </div>
                 </div>
                
                </div>
        <?php } ?>
        <div class ="form-group-row">
        <div class="col-sm-9">
              <button type="submit"  class="btn btn-primary">
                <span class="icon text-white-50">
                </span>
                <span class="text">Simpan</span>
              </button>
              <a href="<?= base_url('panti/profilpanti') ?>" class="btn btn-primary">
                <span class="icon text-white-50">
                </span>
                <span class="text">Kembali</span>
              </a>
         </div>
         </div>
              </div>
         
          <!-- /.card -->

       
  
        <!-- /.container-fluid -->

        </form>