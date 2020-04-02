<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panti</th>
                        <th>Alamat Panti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                     foreach($panti as $row){
                     ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $row['nama_panti']?></td>
                        <td><?= $row['alamat_panti']?></td>
                        <td>
                        <a href="<?php echo site_url("admin/komunitas/detail/");?>"
                             class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-plus"></i>
                        </a>
                        </td>
                    </tr>
                     <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

