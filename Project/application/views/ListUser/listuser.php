<div class="well well-lg">
    <div class="container">
        <h2>Daftar User</h2>
        <span>Halaman yang berisi list para donatur</span>
    </div>
</div>
<div class="container">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>No Telp</th>
            <th width="1">Aksi</th>
        </tr>
        <?php
        foreach($user as $row) {
            ?>
            <tr>
                <td>
                    <b><?php echo $row->nama_user; ?></b>
                </td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->no_telp; ?></td>
                <td>
                    <a href="<?php echo site_url("ListUser/detail/". $row->id_user);?>"class="btn btn-info">
                    Detail</a>
                    <a href="<?php echo site_url("index.php/listuser/delete/". $row->id_user);?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus ini?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<div>