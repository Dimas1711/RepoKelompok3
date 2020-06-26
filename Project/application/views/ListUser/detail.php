<div class="well well-lg">
    <div class="container">
        <h2>Detail List Donatur</h2>
        <span>Detail untuk <b><?php echo $user->nama_user;?></b>.</span>
    </div>
</div>
<div class ="container">
    <table class ="well table table-bordered">
        <tr>
            <td width="200">
                Nama
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->nama_user; ?>
            </td>
        </tr>
        <tr>
            <td>
                Alamat
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->alamat; ?>
            </td>
        </tr>
        <tr>
            <td>
                No Telepon
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->no_telp; ?>
            </td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->email; ?>
            </td>
        </tr>
        <tr>
            <td>
                No Rekening
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->no_rekening; ?>
            </td>
        </tr>
        <tr>
            <td>
                Nama Rekening
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->nama_rekening; ?>
            </td>
        </tr>
        <tr>
            <td>
                Nama Bank
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->nama_bank; ?>
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Lahir
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->tanggal_lahir; ?>
            </td>
        </tr>
        <tr>
            <td>
                Jenis Kelamin
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->jenis_kelamin; ?>
            </td>
        </tr>
        <tr>
            <td>
                Tempat Lahir
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->tempat_lahir; ?>
            </td>
        </tr>
        <tr>
            <td>
                NIK
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->nik; ?>
            </td>
        </tr>
        <tr>
            <td>
                Pekerjaan
            </td>
            <td width="1">:</td>
            <td>
                <?php echo $user->pekerjaan; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <a href="mailto: <?php echo $user->email; ?>" class="btn btn-danger">
                <i class="glyphicon glyphicon-envelope"></i>Kirim Email</a>
                <a href="<?php echo base_url('ListUser') ?>" class="btn btn-danger ">
                <span class="icon text-white-50">
                  <i class="fas fa-reply"></i>
                </span>
                <span class="text">Kembali</span>
            </td>
        </tr>
    </table>
</div>
