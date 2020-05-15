<div class="well well-lg">
    <div class="container"> 
<<<<<<< HEAD
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
                    <label for="nama_yayasanInduk" class="col-sm-3 col-form-label">Ketua Panti</label>
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




























            <!-- <span>Halaman yang berisi informasi panti.</span>
=======
        <h2>Akun Panti</h2>
        <span>Halaman yang berisi informasi panti.</span>
    </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
         <?php foreach($akun as $a){?>
         <div class="card-body">
            <img src="<?= base_url("uploads/panti/"). $a['foto']?>" alt="gambar" width="200">
         </div>
         <table>
            <tr>
                <th>nama panti</th>
                <td><?= $a['nama_panti']?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $a['email']?></td>
            </tr>
            <tr>
                <th>Tanggal Berdiri</th>
                <td><?= $a['tanggal_berdiri']?></td>
            </tr>
            <tr>
                <td>
                <a href="<?php echo base_url("panti/detail/" .$a['id_panti']);?>"
                    class="btn btn-sm btn-success btn-circle">
                   <i class="fas fa-edit"></i>
                 </a>
                </td>
            </tr>
         </table>
         <?php }?>
>>>>>>> f7b0ae44d3333395c25b9cb5e3139d363a4367c8
        </div>
    </div>
    <div class="container-fluid">
        <div class="card-body">
            <div class="table-responsive">
            <//?php foreach($akun as $a){?>
                <table >
                    <tr>
                        <td rowspan="3"><img src="<//?= base_url("uploads/panti/"). $a['foto']?>" alt="gambar"></td>
                        <td><h5><//?= $a['nama_panti']?></h5></td>
                    </tr>
                    <tr>
                        <td ><h5><//?= $a['email']?></h5></td>
                    </tr>
                    <tr>
                        <td><h5><//?= $a['tanggal_berdiri']?></h5></td>
                    </tr>
                </table>
            <//?php }?>
            </div>
        </div>
    </div> -->
