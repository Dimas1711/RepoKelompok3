<div class="well well-lg">
    <div class="container"> 
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
        </div>
    </div>
</div>