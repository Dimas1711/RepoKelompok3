<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Edit Data Panti</h1>
 <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">
  <?php  foreach($please as $a){?>
        <div class="row">
            <div class="col">
                <p>Nama Panti</p>
                    <div class="input-group">
                        <input type="text"
                        id="nama_panti"
                        name="nama_panti"
                                class="form-control border-dark small mb-3"
                                value="<?= $a['nama_panti']?>"
                                aria-describedby="basic-addon2">
                        </div>
                        <?= form_error('nama_panti', '<small class="text-danger">', '</small>')?> 
            </div>
        </div>
        <div class="row">
              <div class="col">
                <p>Nomor Telepon</p>
                  <div class="input-group">
                    <input type="number"
                    id="no_telp"
                    name="no_telp"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Judul"
                           value="<?= $a['no_telp']?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('no_telp', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>
            <div class="row">
              <div class="col">
                <p>Email</p>
                  <div class="input-group">
                    <textarea type="email"
                    id="email"
                    name="email"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['email']?></textarea>
                  </div>
                  <?= form_error('email', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>

                <div class="row">
              <div class="col">
                <p>Nama Ketua Panti</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="nama_yayasanInduk"
                    name="nama_yayasanInduk"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['nama_yayasanInduk']?></textarea>
                  </div>
                  <?= form_error('nama_yayasanInduk', '<small class="text-danger">', '</small>')?> 
                </div>
                </div>

                <div class="row">
              <div class="col">
                <p>Alamat</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="alamat_panti"
                    name="alamat_panti"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['alamat_panti']?></textarea>
                  </div>
                  <?= form_error('alamat_panti', '<small class="text-danger">', '</small>')?> 
                </div>
                </div>

                <div class="row">
              <div class="col">
                <p>Nama Rekening</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="nama_rekening"
                    name="nama_rekening"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['nama_rekening']?></textarea>
                  </div>
                  <?= form_error('nama_rekening', '<small class="text-danger">', '</small>')?> 
                </div>
                </div>

                <div class="row">
              <div class="col">
                <p>No Rekening</p>
                  <div class="input-group">
                    <textarea type="number"
                    id="no_rekening"
                    name="no_rekening"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['no_rekening']?></textarea>
                  </div>
                  <?= form_error('no_rekening', '<small class="text-danger">', '</small>')?> 
                </div>
                </div>

                <div class="row">
              <div class="col">
                <p>Nama Bank</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="nama_bank"
                    name="nama_bank"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           aria-describedby="basic-addon2"><?= $a['nama_bank']?></textarea>
                  </div>
                  <?= form_error('nama_bank', '<small class="text-danger">', '</small>')?> 
                </div>
                </div>

                <div class="row">
              <div class="col">
                <p>Scan KTP Ketua Panti</p>
                  <div class="input-group">
                    <input type="file"
                    id="ktp_pemilik"
                    name="ktp_pemilik"
                           class="form-control border-dark small mb-3"
                           value="<?php $a['ktp_pemilik']?>"
                           aria-describedby="basic-addon2">
                  </div>
                 </div>
                
                </div>
        <?php } ?>
              <button type="submit"  class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Kirim Data</span>
              </button>
              <a href="<?= base_url('panti/editdata') ?>" class="btn btn-danger btn-icon-split">
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