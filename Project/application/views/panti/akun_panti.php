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
                    <label for="nama" class="col-sm-3 col-form-label">Ketua Panti</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama"
                    value="<?= $registrasi ['nama']; ?>">
                    <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>

                <div class="form-group row">
                   <div class="col-sm-3">Foto</div>
                   <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-4">
                               <td><img src="<?= base_url('uploads/akun/') . $registrasi['profil'];?>" class="img-thumbnail"></td> 
                            </div>
                            <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profil" name="profil">
                                <label class="custom-file-label" for="profil">Choose file</label>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>

               
             <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit"  class="btn btn-primary" class="icon text-white-50">Simpan
                    </button>
                    <!--<a href="<//?php echo base_url("panti/profilpanti/");?>"
                    class="btn btn-primary" class="icon text-white-50">Batal</a>-->
                </div>
             </div>
             
            </form> 
            </div>
        </div>