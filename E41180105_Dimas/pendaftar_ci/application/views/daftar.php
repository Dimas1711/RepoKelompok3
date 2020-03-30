<div class="well well-lg">
    <div class="container">
        <h2>Daftar Kerja</h2>
        <span>Halaman untuk melakukan pendaftaran kerja.</span>
    </div>
</div>

<div class="container">
    <div class="alert alert-info">
        <i class="glyphicon glyphicon-info-sign">Silahkan isi data berikut sesuai dengan data diri untuk kami promosikan dalam mencari kerja.</i>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Form Data Pekerja
        </div>
        <div class="panel-body">
            <?php
                if(isset($status))
                {
                    ?>
                    <div class="alert alert-<?php echo $status;?>">
                        <?php echo $message;?>
                    </div>
                    <?php
                } 
            ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap :</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan yang diinginkan :</label>
                            <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Apabila lebih dari satu pisahkan dengan koma (,)" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-send"></i>Submit</button>
                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            </form>
        </div>
    </div>
</div>