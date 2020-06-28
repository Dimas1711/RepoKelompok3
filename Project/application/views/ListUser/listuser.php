<div class="well well-lg">
    <div class="container">
        <h2>Daftar User</h2>
        <span>Halaman yang berisi list para donatur</span>
    </div>
</div>
<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($user as $row) {
                ?>
                  <tr>
                      <td><?= $no++?></td>
                      <td><?= $row->nama_user;?></td>
                      <td><?= $row->email?></td>
                      <td><?= $row->no_telp?></td>
                      <td>
                      <a href="<?php echo site_url("ListUser/detail/". $row->id_user);?>"class="btn btn-info">Detail</a>
                    <a href="<?php echo site_url("index.php/listuser/delete/". $row->id_user);?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus ini?')">Hapus</a>
                      </td>
                  </tr>
                      <?php }?>
                </tbody>
            </table>
        </div>
    </div>