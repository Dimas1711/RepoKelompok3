<div class="well well-lg">
    <div class="container">
        <h2>Daftar Kerja</h2>
        <span>Halaman untuk melakukan pendaftaran kerja.</span>
    </div>
</div>

<div class="container">
    <div class="alert alert-info">
        <i class="glyphicon glyphicon-info-sign"></i> Silahkan isi data berikut sesuai dengan data diri untuk kami promosikan dalam mencari kerja.
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Form Data Pekerja
        </div>
        <div class="panel-body">
            <?php
            if(isset($status)){
                ?>
                <div class="alert alert-<?php echo $status; ?>">
                    <?php echo $message; ?>
                </div>
                <?php
            } ?>

            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="nama" required name="nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" required name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan yang Diinginkan :</label>
                            <input type="pekerjaan" class="form-control" id="pekerjaan" required name="pekerjaan" placeholder="Apabila lebih dari satu pisahkan dengan tanda koma (,)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea class="form-control" id="alamat" required name="alamat" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="resume">Resume/Tentang Anda :</label>
                            <textarea class="form-control" id="resume" required name="resume" rows="8"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-send"></i>Submit</button>
                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            </form>
        </div>
    </div>
</div>