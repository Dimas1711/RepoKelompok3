<div class="well well-lg">
    <div class="container"> 
        <h2>List Panti</h2>
        <span>Halaman yang berisi List Panti yang ada. </span>
    </div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="table-responsive">
        <div class="card-header py-3">
                <a href="<?= base_url('tampilPanti/tambahpanti') ?>"
                   class="btn btn-sm btn-info btn-icon-split shadow-sm">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                  </span>
                  <span class="text">Tambah Panti</span>
                </a>

               
                <div class="col mt-4">
                <?php echo $this->session->flashdata('pesan')?>
                </div>
              </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Panti</th>
                        <th>Nama Panti</th>
                        <th>Alamat Panti</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($listpanti as $b) {
                ?>
                    <tr>
                        <td><?= $b['id_panti'];?></td>
                        <td><?= $b['nama_panti'];?></td>
                        <td><?= $b['alamat_panti'];?></td>
                        <td><?= $b['gambar'];?></td>
                        <td>
                        <a href="<?php echo base_url("tampilPanti/detailpanti/".$b['id_panti']);?>"
                             class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="<?php echo base_url("tampilPanti/editdata/".$b['id_panti']);?>"
                             class="btn btn-sm btn-success btn-circle">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="#"
                             onclick="confirm_modal('<?= 'tampilPanti/hapus/'.$b['id_panti'] ?>')"
                             class="btn btn-sm btn-danger btn-circle"
                             data-toggle="modal" data-target="#hapusModal">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?</h5>
                          <button class="close" type="button" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke Panel Admin.</div>
                        <div class="modal-footer">
                          <button class="btn btn-info" type="button" data-dismiss="modal">Batal</button>
                          <a id="delete_link" class="btn btn-danger" href="">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
                function confirm_modal(delete_url) {
                    $('#hapusModal').modal('show', {
                        backdrop: 'static'
                    });
                    document.getElementById('delete_link').setAttribute('href', delete_url);
                }
            </script>
    </div>
