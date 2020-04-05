<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Tambah Berita</h1>
 <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">

        <div class="row">
            <div class="col">
                <p>Tanggal</p>
                    <div class="input-group">
                        <input type="date"
                        id="tgl"
                        name="tgl"
                                class="form-control border-dark small mb-3"
                                value="<?php echo set_value('tgl')?>"
                                aria-describedby="basic-addon2">
                        </div>
                        <?= form_error('tgl', '<small class="text-danger">', '</small>')?> 
            </div>
        </div>
        <div class="row">
              <div class="col">
                <p>Judul</p>
                  <div class="input-group">
                    <input type="text"
                    id="judul"
                    name="judul"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Judul"
                           value="<?php echo set_value('judul')?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('judul', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>
            <div class="row">
              <div class="col">
                <p>Isi Berita</p>
                  <div class="input-group">
                    <textarea type="text"
                    id="isi"
                    name="isi"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Isi Berita"
                           value="<?php echo set_value('isi')?>"
                           aria-describedby="basic-addon2"></textarea>
                  </div>
                  <?= form_error('isi', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>
                <div class="row">
              <div class="col">
                <p>Gambar Berita</p>
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
                <span class="text">Kirim Data</span>
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