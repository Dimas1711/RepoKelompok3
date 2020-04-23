<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Edit Finansial</h1>
 <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">
  <?php  foreach($admin as $a){?>
        <div class="row">
            <div class="col">
            <p>Nama Rekening</p>
                  <div class="input-group">
                    <input type="text"
                    id="nama_rekening"
                    name="nama_rekening"
                           class="form-control border-dark small mb-3"
                                value="<?= $a['nama_rekening']?>"
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
                           value="<?= $a['no_rekening']?>"
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
                           value="<?= $a['nama_bank']?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nama_bank', '<small class="text-danger">', '</small>')?> 
                </div>
            </div>

       
        <?php } ?>
              <button type="submit"  class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Kirim Data</span>
              </button>
              <a href="<?= base_url('admin/data_bank') ?>" class="btn btn-danger btn-icon-split">
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