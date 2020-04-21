<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Tambah Panti</h1>
 <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">

          <div class="row">
              <div class="col">
                <p>Nama Panti</p>
                  <div class="input-group">
                    <input type="text"
                    id="nama_panti"
                    name="nama_panti"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Nama Panti"
                           value="<?php echo set_value('nama_panti')?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nama_panti', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>No Telpon</p>
                  <div class="input-group">
                    <input type="number"
                    id="no_telp"
                    name="no_telp"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan No Telpon"
                           value="<?php echo set_value('no_telp')?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('no_telp', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>Nama Yayasan</p>
                  <div class="input-group">
                    <input type="text"
                    id="nama_yayasanInduk"
                    name="nama_yayasanInduk"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Nama Yayasan"
                           value="<?php echo set_value('nama_yayasanInduk')?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nama_yayasanInduk', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
            <div class="col">
                <p>Tanggal Berdiri</p>
                    <div class="input-group">
                        <input type="date"
                        id="tanggal_berdiri"
                        name="tanggal_berdiri"
                                class="form-control border-dark small mb-3"
                                value="<?php echo set_value('tanggal_berdiri')?>"
                                aria-describedby="basic-addon2">
                        </div>
                        <?= form_error('tanggal_berdiri', '<small class="text-danger">', '</small>')?> 
            </div>
        </div> 

        <div class="row">
              <div class="col">
                <p>Alamat Panti</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="alamat_panti"
                    name="alamat_panti"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Alamat Panti"
                           value="<?php echo set_value('alamat_panti')?>"
                           aria-describedby="basic-addon2"></textarea>
                  </div>
                  <?= form_error('alamat_panti', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>Nama Rekening</p>
                  <div class="input-group">
                    <input type="text"
                    id="nama_rekening"
                    name="nama_rekening"
                          class="form-control border-dark small mb-3"
                          placeholder="Masukkan Nama Rekening"
                          value="<?php echo set_value('nama_rekening')?>"
                          aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nama_rekening', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>No Rekening</p>
                  <div class="input-group">
                    <input type="number"
                    id="no_rekening"
                    name="no_rekening"
                          class="form-control border-dark small mb-3"
                          placeholder="Masukkan No Rekening"
                          value="<?php echo set_value('no_rekening')?>"
                          aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('no_rekening', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>Nama Bank</p>
                  <div class="input-group">
                    <input type="text"
                    id="nama_bank"
                    name="nama_bank"
                          class="form-control border-dark small mb-3"
                          placeholder="Masukkan Nama Bank"
                          value="<?php echo set_value('nama_bank')?>"
                          aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nama_bank', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>

          <div class="row">
              <div class="col">
                <p>Email</p>
                  <div class="input-group">
                    <input type="email"
                    id="email"
                    name="email"
                          class="form-control border-dark small mb-3"
                          placeholder="Masukkan Email"
                          value="<?php echo set_value('email')?>"
                          aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('email', '<small class="text-danger">', '</small>')?> 
              </div>
          </div>
            
                <div class="row">
              <div class="col">
                <p>Foto</p>
                  <div class="input-group">
                    <input type="file"
                    id="gambar"
                    name="gambar"
                           class="form-control border-dark small mb-3"
                           value="<?php echo set_value('gambar')?>"
                           aria-describedby="basic-addon2">
                  </div>
                 </div>
                </div>

              <button type="submit" href="<?= base_url('berita/tambahberita') ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
              </button>
              <a href="<?= base_url('Berita/index') ?>" class="btn btn-danger btn-icon-split">
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

        </form>