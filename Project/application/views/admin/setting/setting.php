<div class="well well-lg">
    <div class="container"> 
        <h2>Edit Profile</h2>
       
        <div class="row">
            <div class="col-lg-8">
        
            <?= form_open_multipart('panti/akun_panti');?>
            <form>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email"
                    value="<?= $registrasi ['email']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password"  
                    value="<?= $registrasi ['password']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_yayasanInduk" class="col-sm-3 col-form-label">Full Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_yayasanInduk" name="nama_yayasanInduk"
                    value="<?= $registrasi ['nama']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                   <div class="col-sm-2">Foto Panti</div>
                   <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="" class="img-thumbail">
                            </div>
                            <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto">
                                <label class="custom-file-label" for="foto">Choose file</label>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Edit</button> 
                    
                    </div>
                </div>

            </form>
            
            </div>
        </div>




   
   
   
   
    <!-- <div class="well well-lg">
        <div class="container">
            <h2>Admin</h2>
            <span>Halaman yang berisi Data Admin </span>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card-body">
            <div class="table-responsive">
            <div class="card-header py-3">
                    <div class="col mt-4">
                    <//?php echo $this->session->flashdata('pesan')?>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <//?php 
                        $no = 1;
                        foreach ($admin as $b) {
                    ?>
                        <tr>
                            <td></?= $no++?></td>
                            <td></?= $b['nama'];?></td>
                            <td></?= $b['level'];?></td>
                            <td></?= $b['tanggal_bergabung'];?></td>
                            <td>
                            <a href="</?php echo base_url("admin/detail_setting/".$b['id_admin']);?>"
                                class="btn btn-sm btn-primary btn-circle">
                                <i class="fas fa-plus"></i>
                            </a>
                            
                            </td>
                        </tr>
                        </?php  } ?>
                    </tbody>
                </table>
                <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?</h5>
                            <button class="close" type="button" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke Panel Admin.</div>
                            <div class="modal-footer">
                            <button class="btn btn-info" type="button" data-dismiss="modal">Batal</button>
                            <a id="delete_link" class="btn btn-danger" href="">Hapus</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <script type="text/javascript">
                    function confirm_modal(delete_url) {
                        $('#hapusModal').modal('show', {
                            backdrop: 'static'
                        });
                        document.getElementById('delete_link').setAttribute('href', delete_url);
                    }
                </script>
        </div> -->
