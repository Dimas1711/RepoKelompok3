<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
    <div>
    <input type="hidden" name="id_panti" value="<?= $panti['id_panti']?>">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <div class="col-md-3">
            <!-- <input type="text" name="id_kategori" value="2"> -->
            <select class="form-control" name="id_kategori" id="">
                <option value="1">tes</option>
                <option value="2">tes 2</option>
                <option value="3">tes 3</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="tujuan_dana">Tujuan Dana</label>
        <div class="col-md-5">
            <input type="text" class="form-control" id="tujuan_dana" name="tujuan_dana" aria-describedby="emailHelp" value="<?php echo set_value('tujuan_dana')?>">
            <?= form_error('tujuan_dana', '<small class="text-danger">', '</small>')?>
        </div>
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <div class="col-md-5">
            <input type="date" class="form-control" id="tanggal" name="tanggal">
            <?= form_error('tanggal', '<small class="text-danger">', '</small>')?>
        </div>
    </div>
    <div class="form-group">
        <label for="tenggat_waktu">Tenggat Waktu</label>
        <div class="col-md-5">
            <input type="date" class="form-control" id="tenggat_waktu" name="tenggat_waktu">
            <?= form_error('tenggat_waktu', '<small class="text-danger">', '</small>')?>
        </div>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <div class="col-md-8">
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" value="<?php echo set_value('deskripsi')?>"></textarea>
            <?= form_error('deskripsi', '<small class="text-danger">', '</small>')?>
        </div>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <div class="col-md-5">
            <input type="file" class="form-control-file" name="foto" id="foto">
        </div>
    </div>

    <button type="submit" name="submit" href="<?php echo base_url('panti/addKasus') ?>" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Kirim Data</span>
    </button>
    </form> 
</div>


