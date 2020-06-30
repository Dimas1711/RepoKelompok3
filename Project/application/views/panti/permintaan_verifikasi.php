<div class="container-fluid">

<?php if ($registrasi['status'] == 1) {?>
<div class="col mt-3">
    <div class="alert alert-success" role="alert">
                            Data Panti Telah Disetujui Oleh Admin
    </div>
</div>
<?php }  else if ($registrasi['status'] == 2) {?>
     <div class="alert alert-danger" role="alert">
    Maaf Panti Anda Tidak Disetujui Oleh Admin . Silahkan Anda Hubungi Admin 
</div>
<?php }else {?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Permintaan Verifikasi Panti</h1>

  <form action="" method="post" enctype="multipart/form-data">

<div class="card shadow mb-4">
  <div class="card-body">
  <p>Data Panti</p>
  <hr>
    <div class="row">
      <div class="col-sm-6">
        <p>Nama Panti</p>
        <div class="input-group">
        <input type="hidden"
              name="id"
              id="id"
                 class="form-control border-dark small mb-3"
                 placeholder="Masukkan Nama Panti"
                 aria-describedby="basic-addon2"
                 value="<?= $registrasi['id_registrasi']?>"
                 >
          <input type="text"
              name="nama_panti"
              id="nama_panti"
                 class="form-control border-dark small mb-3"
                 placeholder="Masukkan Nama Panti"
                 aria-describedby="basic-addon2"
                 value="<?php echo set_value('nama_panti')?>"
                 >
        </div>
                 <?= form_error('nama_panti', '<small class="text-danger">', '</small>')?>
      </div>
            <div class="col-sm-6">
            <p>Nama Ketua Panti</p>
                  <div class="input-group">
                  <input type="text"
                           id="ketua_panti"
                           name="ketua_panti"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Nama Ketua panti"
                           aria-describedby="basic-addon2"
                           value="<?php echo set_value('ketua_panti')?>"
                           >
                  </div> 
                  <?= form_error('ketua_panti', '<small class="text-danger">', '</small>')?> 
                </div>
              </div>

              <div class="row">
      <div class="col-sm-6">
        <p>No.KTP Ketua Panti</p>
        <div class="input-group">
        <input type="hidden"
              name="id"
              id="id"
                 class="form-control border-dark small mb-3"
                 placeholder="Masukkan Nomor KTP"
                 aria-describedby="basic-addon2"
                 value="<?= $registrasi['id_registrasi']?>"
                 >
          <input type="number"
              name="no_ktp"
              id="no_ktp"
                 class="form-control border-dark small mb-3"
                 placeholder="Masukkan Nomor KTP"
                 aria-describedby="basic-addon2"
                 value="<?php echo set_value('no_ktp')?>"
                 >
        </div>
                 <?= form_error('no_ktp', '<small class="text-danger">', '</small>')?>
      </div>
      <div class="col-sm-6">
                  <p>Foto KTP Ketua Panti</p>
                  <div class="input-group">
                    <input name="ktp_pemilik" id="ktp_pemilik"
                           type="file"
                           class="form-control border-dark small mb-3"
                           placeholder=""
                           aria-describedby="basic-addon2"
                           >
                  </div>
                </div>
                </div>

              <div class="row">
                <div class="col-sm-6">
                <p>Pilih Provinsi</p>
                  <div class="input-group">
                    <select class="form-control border-dark small mb-3"
                            id="provinsi"
                            name="provinsi"
                            value="">
                            <?php foreach($data->result() as $row):?>
                            
                                <option value="<?php echo $row->id_provinsi;?>"><?php echo $row->nama_provinsi;?></option>
                            <?php endforeach;?>
                     
                    </select>
                  </div>
                  </div>

                <div class="col-sm-6">
                  <p>Kabupaten</p>
                  <div class="input-group">
                    <select class="form-control border-dark small mb-3"
                            id="kabupaten"
                            name="kabupaten"
                            value="<?php echo set_value('kabupaten')?>">
                            <option value="">-PILIH-</option>
                     
                    </select>
                  </div>
                </div>
              </div>
              <p>Alamat</p>
              <div class="input-group">
                <textarea type="text"
                       id="alamat"
                       name="alamat"
                       class="form-control border-dark small mb-3"
                       placeholder="Masukkan Alamat Panti"
                       value="<?php echo set_value('alamat')?>"
                       aria-describedby="basic-addon2"></textarea>
              </div>
              <?= form_error('alamat', '<small class="text-danger">', '</small>')?> 
              <p>Deskripsi Panti</p>
              <div class="input-group">
                <textarea type="text"
                       id="deskripsi_panti"
                       name="deskripsi_panti"
                       class="form-control border-dark small mb-3"
                       placeholder="Masukkan Deskripsi Panti"
                       value="<?php echo set_value('deskripsi_komunitas')?>"
                       aria-describedby="basic-addon2"></textarea>
              </div>
              <?= form_error('deskripsi_panti', '<small class="text-danger">', '</small>')?> 

              <div class="row">
              <div class="col-sm-6">
                  <p>Tanggal Berdiri Panti</p>
                  <div class="input-group">
                    <input type="date"
                          id="tgl"
                          name="tgl"
                          class="form-control border-dark small mb-3"
                          placeholder="Masukkan Tanggal Berdiri Panti"
                          aria-describedby="basic-addon2"
                                value="<?php echo set_value('tgl')?>"
                          >
                  </div>
                  
                  <?= form_error('tgl', '<small class="text-danger">', '</small>')?> 
                </div>
                
                <div class="col-sm-6">
                  <p>Telepon/Whatsapp</p>
                  <div class="input-group">
                    <input type="number"
                    id="no_telp"
                    name="no_telp"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan No Telepon/Whatsapp"
                           value="<?php echo set_value('no_telp')?>"
                           aria-describedby="basic-addon2"
                           >
                  </div>
                  <?= form_error('no_telp', '<small class="text-danger">', '</small>')?> 
                </div>
            </div>
              <div class="row">
            
                 
                  <div class="input-group">
                    <input type="hidden"
                    id="email"
                    name="email"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Email"
                           value="<?= $registrasi['email']?>"
                           aria-describedby="basic-addon2"
                           >
                </div>
                
                <div class="col-sm-6">
                  <p>Upload File Surat Pengesahan</p>
                  <div class="input-group">
                    <input name="surat_pengesahan" id="surat_pengesahan"
                           type="file"
                           class="form-control border-dark small mb-3"
                           placeholder=""
                           aria-describedby="basic-addon2"
                           >
                  </div>
                </div>

                <div class="col-sm-6">
                  <p>Logo Panti</p>
                  <div class="input-group">
                    <input name="foto" id="foto"
                           type="file"
                           class="form-control border-dark small mb-3"
                           placeholder=""
                           aria-describedby="basic-addon2"
                           >
                  </div>
                </div>
                
                </div>
              <hr>
              <p>Finansial</p>
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
                <p>Nomor Rekening</p>
                  <div class="input-group">
                    <input type="text"
                    id="nomor_rekening"
                    name="nomor_rekening"
                           class="form-control border-dark small mb-3"
                           placeholder="Masukkan Nomor Rekening"
                           value="<?php echo set_value('nomor_rekening')?>"
                           aria-describedby="basic-addon2">
                  </div>
                  <?= form_error('nomor_rekening', '<small class="text-danger">', '</small>')?> 
                </div>
                
                </div>
              <button type="submit" href="<?php echo base_url('panti/permintaan_verifikasi') ?>" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Kirim Data</span>
              </button>
              <a href="<?php echo site_url('admin/komunitas') ?>" class="btn btn-danger btn-icon-split">
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
      </div>
                            <?php } ?>
      <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
      <script type="text/javascript" src="<?php echo base_url().'assets/js/script.js'?>"></script>

      <script type="text/javascript">
      $(document).ready(function() {
          $('#provinsi').change(function() {
              var id_provinsi=$(this).val();//id provinsi
              console.log(id_provinsi);
              $.ajax({
                  url:"<?= base_url();?>panti/get_subkategori",
                  method:"POST",
                  data : {id_provinsi: id_provinsi},
                  async : false,
                  dataType:"json",
                  success : function (data) {
                    var html = '';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].id_kabupaten+'">'+data[i].nama_kabupaten+'</option>';
                    }
                    $('#kabupaten').html(html);
                    console.log(html);
                  }
              });
          });
      });

      
      
      </script>